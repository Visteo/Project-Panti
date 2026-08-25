<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransNotificationController extends Controller
{
    public function handle(Request $request): JsonResponse
    {
        $orderId = (string) $request->input('order_id');
        $statusCode = (string) $request->input('status_code');
        $grossAmount = (string) $request->input('gross_amount');
        $signatureKey = (string) $request->input('signature_key');

        if (
            !$orderId ||
            !$statusCode ||
            !$grossAmount ||
            !$signatureKey
        ) {
            return response()->json([
                'message' => 'Notification data is incomplete.',
            ], 422);
        }

        $expectedSignature = hash(
            'sha512',
            $orderId .
            $statusCode .
            $grossAmount .
            config('midtrans.server_key')
        );

        if (!hash_equals($expectedSignature, $signatureKey)) {
            Log::warning('Invalid Midtrans signature', [
                'order_id' => $orderId,
            ]);

            return response()->json([
                'message' => 'Invalid signature.',
            ], 403);
        }

        $donation = Donation::where(
            'invoice_number',
            $orderId
        )->first();

        if (!$donation) {
            Log::warning('Midtrans donation not found', [
                'order_id' => $orderId,
            ]);

            return response()->json([
                'message' => 'Donation not found.',
            ], 404);
        }

        if (
            (int) round((float) $grossAmount)
            !== (int) round((float) $donation->amount)
        ) {
            Log::warning('Midtrans amount does not match', [
                'order_id' => $orderId,
                'notification_amount' => $grossAmount,
                'donation_amount' => $donation->amount,
            ]);

            return response()->json([
                'message' => 'Transaction amount does not match.',
            ], 422);
        }

        $transactionStatus = (string) $request->input(
            'transaction_status'
        );

        $fraudStatus = (string) $request->input(
            'fraud_status',
            ''
        );

        $paymentStatus = $this->mapPaymentStatus(
            $transactionStatus,
            $fraudStatus
        );
        if (
            $donation->payment_status === 'paid'
            && $paymentStatus !== 'paid'
        ) {
            return response()->json([
                'message' => 'Donation has already been paid.',
            ]);
        }

        $updateData = [
            'payment_status' => $paymentStatus,
            'payment_reference' => $request->input(
                'transaction_id'
            ),
            'payment_channel' => $request->input(
                'payment_type'
            ),
        ];

        if ($paymentStatus === 'paid') {
            $updateData['paid_at'] = $donation->paid_at ?? now();
        } elseif ($donation->payment_status !== 'paid') {
            $updateData['paid_at'] = null;
        }

        $donation->update($updateData);

        Log::info('Midtrans notification processed', [
            'invoice' => $donation->invoice_number,
            'transaction_status' => $transactionStatus,
            'payment_status' => $paymentStatus,
        ]);

        return response()->json([
            'message' => 'Notification processed successfully.',
        ]);
    }

    private function mapPaymentStatus(
        string $transactionStatus,
        string $fraudStatus
    ): string {
        if ($transactionStatus === 'settlement') {
            return 'paid';
        }

        if ($transactionStatus === 'capture') {
            return $fraudStatus === 'accept'
                ? 'paid'
                : 'pending';
        }

        return match ($transactionStatus) {
            'pending' => 'pending',
            'deny', 'failure' => 'failed',
            'expire' => 'expired',
            'cancel' => 'cancelled',
            default => 'pending',
        };
    }
}