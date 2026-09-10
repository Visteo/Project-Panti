

<?php $__env->startSection('title', 'Harapan Bangsa | Berbagi Harapan'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .hero {
            position: relative;
            min-height: 720px;
            display: flex;
            align-items: center;
            padding: 115px 0 155px;
            overflow: hidden;
            background-color: #12355b;
            background-position: center;
            background-size: cover;
            color: white;
        }

        .hero::before {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(
                    90deg,
                    rgba(9, 30, 51, 0.96) 0%,
                    rgba(18, 53, 91, 0.86) 48%,
                    rgba(18, 53, 91, 0.35) 100%
                );
            content: "";
        }

        .hero::after {
            position: absolute;
            right: -130px;
            bottom: -240px;
            width: 520px;
            height: 520px;
            border: 90px solid rgba(255, 255, 255, 0.07);
            border-radius: 50%;
            content: "";
        }

        .hero-grid {
            position: relative;
            z-index: 2;
            display: grid;
            align-items: center;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 70px;
        }

        .hero-content {
            max-width: 720px;
        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 14px;
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 30px;
            background: rgba(255, 255, 255, 0.1);
            color: #fbbf24;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            backdrop-filter: blur(10px);
        }

        .hero-label::before {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #f59e0b;
            box-shadow: 0 0 0 5px rgba(245, 158, 11, 0.18);
            content: "";
        }

        .hero h1 {
            max-width: 750px;
            margin: 22px 0 20px;
            color: white;
            font-size: clamp(44px, 6vw, 76px);
            font-weight: 800;
            line-height: 1.05;
            letter-spacing: -2px;
        }

        .hero h1 span {
            color: #fbbf24;
        }

        .hero-description {
            max-width: 620px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 18px;
            line-height: 1.8;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 13px;
            margin-top: 32px;
        }

        .btn-hero-primary,
        .btn-hero-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 50px;
            padding: 13px 22px;
            border-radius: 13px;
            font-weight: 800;
            text-decoration: none;
            transition: 0.25s;
        }

        .btn-hero-primary {
            background: #f59e0b;
            color: #172033;
            box-shadow: 0 12px 28px rgba(245, 158, 11, 0.28);
        }

        .btn-hero-primary:hover {
            transform: translateY(-3px);
            background: #fbbf24;
        }

        .btn-hero-secondary {
            border: 1px solid rgba(255, 255, 255, 0.35);
            background: rgba(255, 255, 255, 0.08);
            color: white;
            backdrop-filter: blur(10px);
        }

        .btn-hero-secondary:hover {
            transform: translateY(-3px);
            background: white;
            color: #12355b;
        }

        .hero-message-card {
            position: relative;
            max-width: 390px;
            margin-left: auto;
            padding: 35px;
            border: 1px solid rgba(255, 255, 255, 0.23);
            border-radius: 30px;
            background: rgba(255, 255, 255, 0.12);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.17);
            backdrop-filter: blur(16px);
        }

        .hero-message-icon {
            display: grid;
            width: 64px;
            height: 64px;
            margin-bottom: 55px;
            place-items: center;
            border-radius: 20px;
            background: #ef6a5b;
            color: white;
            font-size: 29px;
        }

        .hero-message-card h2 {
            margin-bottom: 13px;
            color: white;
            font-size: 28px;
            line-height: 1.25;
        }

        .hero-message-card p {
            color: rgba(255, 255, 255, 0.72);
            line-height: 1.7;
        }

        .hero-message-accent {
            position: absolute;
            top: 32px;
            right: 32px;
            color: rgba(255, 255, 255, 0.16);
            font-size: 75px;
            font-weight: 900;
            line-height: 1;
        }

        .statistics-section {
            position: relative;
            z-index: 5;
            margin-top: -75px;
            padding: 0 24px;
        }

        .statistics-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 28px;
            background: white;
            box-shadow: 0 25px 60px rgba(18, 53, 91, 0.16);
        }

        .statistics-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
        }

        .statistic {
            position: relative;
            padding: 32px 28px;
        }

        .statistic + .statistic {
            border-left: 1px solid #e5e7eb;
        }

        .statistic-top {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .statistic-icon {
            display: grid;
            width: 51px;
            height: 51px;
            flex: 0 0 51px;
            place-items: center;
            border-radius: 16px;
            font-size: 22px;
        }

        .statistic:nth-child(1) .statistic-icon {
            background: #eaf4ff;
            color: #12355b;
        }

        .statistic:nth-child(2) .statistic-icon {
            background: #fff1ed;
            color: #ef6a5b;
        }

        .statistic:nth-child(3) .statistic-icon {
            background: #fef3c7;
            color: #92400e;
        }

        .statistic strong {
            display: block;
            color: #172033;
            font-size: clamp(22px, 2.5vw, 31px);
            line-height: 1.2;
        }

        .statistic span {
            display: block;
            margin-top: 5px;
            color: #6b7280;
            font-size: 13px;
        }

        @media (max-width: 900px) {
            .hero {
                min-height: auto;
                padding: 100px 0 145px;
            }

            .hero-grid {
                grid-template-columns: 1fr;
            }

            .hero-message-card {
                max-width: 100%;
                margin-left: 0;
            }

            .statistics-grid {
                grid-template-columns: 1fr;
            }

            .statistic + .statistic {
                border-top: 1px solid #e5e7eb;
                border-left: 0;
            }
        }

       .home-news-section {
            position: relative;
            padding: 105px 24px;
            overflow: hidden;
            background: #ffffff;
        }

        .home-news-wrapper {
            position: relative;
            overflow: hidden;
            padding: 75px 65px;
            border-radius: 50px;
            background: #12355b;
            box-shadow: 0 30px 70px rgba(18, 53, 91, 0.18);
        }

        .home-news-wrapper::before {
            position: absolute;
            top: -120px;
            right: -90px;
            width: 310px;
            height: 310px;
            border: 65px solid rgba(255, 255, 255, 0.06);
            border-radius: 50%;
            content: "";
        }

        .home-news-wrapper::after {
            position: absolute;
            bottom: -130px;
            left: -90px;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: rgba(239, 106, 91, 0.13);
            content: "";
        }

        .home-news-heading {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 35px;
            margin-bottom: 42px;
        }

        .home-news-heading-content {
            max-width: 680px;
        }

        .home-news-label {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 13px;
            color: #fbbf24;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        .home-news-label::before {
            width: 30px;
            height: 3px;
            border-radius: 5px;
            background: #fbbf24;
            content: "";
        }

        .home-news-heading h2 {
            margin-bottom: 12px;
            color: white;
            font-size: clamp(32px, 4vw, 48px);
            line-height: 1.15;
        }

        .home-news-heading p {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.75;
        }

        .home-news-all {
            border-color: rgba(255, 255, 255, 0.35);
            color: white;
        }

        .home-news-all:hover {
            background: white;
            color: #12355b;
        }

        .home-news-layout {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 24px;
        }

        .home-news-featured {
            position: relative;
            min-height: 540px;
            overflow: hidden;
            border-radius: 30px;
            background: #0c2947;
        }

        .home-news-featured img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .home-news-featured:hover img {
            transform: scale(1.05);
        }

        .home-news-featured::after {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(
                    to top,
                    rgba(8, 27, 46, 0.97) 0%,
                    rgba(8, 27, 46, 0.42) 60%,
                    rgba(8, 27, 46, 0.08) 100%
                );
            content: "";
        }

        .home-news-featured-placeholder {
            position: absolute;
            inset: 0;
            display: grid;
            place-items: center;
            background:
                linear-gradient(
                    135deg,
                    #194b76,
                    #256b8f
                );
            color: rgba(255, 255, 255, 0.22);
            font-size: 95px;
            font-weight: 900;
        }

        .home-news-featured-content {
            position: absolute;
            z-index: 2;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 38px;
        }

        .home-news-featured-date {
            display: inline-flex;
            padding: 8px 13px;
            border-radius: 20px;
            background: #f59e0b;
            color: #172033;
            font-size: 12px;
            font-weight: 800;
        }

        .home-news-featured h3 {
            margin: 17px 0 11px;
            color: white;
            font-size: clamp(25px, 3vw, 36px);
            line-height: 1.25;
        }

        .home-news-featured p {
            color: rgba(255, 255, 255, 0.75);
            line-height: 1.7;
        }

        .home-news-featured-link {
            display: inline-flex;
            margin-top: 18px;
            color: #fbbf24;
            font-weight: 800;
            text-decoration: none;
        }

        .home-news-secondary {
            display: grid;
            align-content: start;
            gap: 20px;
        }

        .home-news-small {
            display: grid;
            grid-template-columns: 180px 1fr;
            min-height: 250px;
            overflow: hidden;
            border-radius: 25px;
            background: white;
            transition: transform 0.25s;
        }

        .home-news-small:hover {
            transform: translateY(-5px);
        }

        .home-news-small-image {
            height: 100%;
            min-height: 250px;
            overflow: hidden;
            background: #eaf4ff;
        }

        .home-news-small-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s;
        }

        .home-news-small:hover img {
            transform: scale(1.05);
        }

        .home-news-small-placeholder {
            display: grid;
            width: 100%;
            height: 100%;
            place-items: center;
            background: #eaf4ff;
            color: #12355b;
            font-size: 30px;
            font-weight: 900;
        }

        .home-news-small-content {
            padding: 25px 21px;
        }

        .home-news-small-date {
            color: #ef6a5b;
            font-size: 12px;
            font-weight: 800;
        }

        .home-news-small h3 {
            margin: 10px 0;
            color: #172033;
            font-size: 19px;
            line-height: 1.4;
        }

        .home-news-small p {
            color: #6b7280;
            font-size: 13px;
            line-height: 1.6;
        }

        .home-news-small-link {
            display: inline-flex;
            margin-top: 14px;
            color: #12355b;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
        }

        @media (max-width: 1000px) {
            .home-news-layout {
                grid-template-columns: 1fr;
            }

            .home-news-secondary {
                grid-template-columns: repeat(2, 1fr);
            }

            .home-news-small {
                grid-template-columns: 1fr;
            }

            .home-news-small-image {
                height: 220px;
                min-height: 220px;
            }
        }

        @media (max-width: 650px) {
            .home-news-section {
                padding: 70px 12px;
            }

            .home-news-wrapper {
                padding: 48px 20px;
                border-radius: 30px;
            }

            .home-news-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .home-news-featured {
                min-height: 500px;
            }

            .home-news-featured-content {
                padding: 27px 22px;
            }

            .home-news-secondary {
                grid-template-columns: 1fr;
            }

            .home-news-small {
                grid-template-columns: 125px 1fr;
            }

            .home-news-small-image {
                height: auto;
                min-height: 210px;
            }
        }

        @media (max-width: 430px) {
            .home-news-small {
                grid-template-columns: 1fr;
            }

            .home-news-small-image {
                height: 200px;
            }
        }

        .campaign-footer {
            margin-top: 18px;
        }

        .identity-section {
            position: relative;
            padding: 105px 24px;
            overflow: hidden;
            background: #ffffff;
        }

        .identity-wrapper {
            position: relative;
            overflow: hidden;
            padding: 70px;
            border-radius: 48px;
            background:
                linear-gradient(
                    135deg,
                    #12355b 0%,
                    #194b76 55%,
                    #256b8f 100%
                );
            color: white;
            box-shadow: 0 30px 70px rgba(18, 53, 91, 0.18);
        }

        .identity-wrapper::before {
            position: absolute;
            top: -130px;
            right: -90px;
            width: 330px;
            height: 330px;
            border: 65px solid rgba(255, 255, 255, 0.07);
            border-radius: 50%;
            content: "";
        }

        .identity-wrapper::after {
            position: absolute;
            bottom: -130px;
            left: -100px;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: rgba(245, 158, 11, 0.13);
            content: "";
        }

        .identity-heading {
            position: relative;
            z-index: 2;
            max-width: 650px;
            margin-bottom: 45px;
        }

        .identity-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
            color: #fbbf24;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .identity-label::before {
            width: 30px;
            height: 3px;
            border-radius: 5px;
            background: #fbbf24;
            content: "";
        }

        .identity-heading h2 {
            margin-bottom: 14px;
            color: white;
            font-size: clamp(32px, 4vw, 48px);
            line-height: 1.15;
        }

        .identity-heading p {
            color: rgba(255, 255, 255, 0.72);
            font-size: 16px;
            line-height: 1.8;
        }

        .identity-grid {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 0.85fr 1.15fr;
            gap: 24px;
        }

        .vision-panel,
        .mission-panel {
            position: relative;
            padding: 36px;
            border-radius: 30px;
        }

        .vision-panel {
           display: flex;
             min-height: 350px;
            flex-direction: column;
            justify-content: flex-start;
            gap: 30px;
            background: #f59e0b;
            color: #172033;
        }

        .vision-panel h3 {
            margin: 0 0 13px;
        }

        .vision-icon {
            display: grid;
            width: 58px;
            height: 58px;
            place-items: center;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.45);
            font-size: 27px;
        }

        .vision-panel h3,
        .mission-panel h3 {
            font-size: 28px;
        }

        .vision-panel h3 {
            margin: 0 0 13px;
        }

        .mission-panel h3 {
            margin: 0 0 20px;
        }

        .vision-panel p {
            font-size: 18px;
            font-weight: 600;
            line-height: 1.75;
        }

        .mission-panel {
            border: 1px solid rgba(255, 255, 255, 0.18);
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
        }

        .mission-panel h3 {
            color: white;
        }

        .mission-list {
            display: grid;
            gap: 13px;
            margin: 20px 0 0;
            padding: 0;
            list-style: none;
        }

        .mission-item {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            padding: 15px 17px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
        }

        .mission-number {
            display: grid;
            width: 30px;
            height: 30px;
            flex: 0 0 30px;
            place-items: center;
            border-radius: 50%;
            background: #f59e0b;
            color: #172033;
            font-size: 12px;
            font-weight: 800;
        }

        .home-events-section {
            position: relative;
            padding: 105px 24px;
            overflow: hidden;
            background: #ffffff;
        }

        .home-events-wrapper {
            position: relative;
            overflow: hidden;
            padding: 70px;
            border-radius: 48px;
            background: #fff8ed;
        }

        .home-events-wrapper::before {
            position: absolute;
            top: -110px;
            right: -80px;
            width: 270px;
            height: 270px;
            border-radius: 50%;
            background: rgba(245, 158, 11, 0.14);
            content: "";
        }

        .home-events-heading {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 30px;
            margin-bottom: 40px;
        }

        .home-events-heading-content {
            max-width: 650px;
        }

        .home-events-label {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 13px;
            color: #ef6a5b;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        .home-events-label::before {
            width: 30px;
            height: 3px;
            border-radius: 5px;
            background: #ef6a5b;
            content: "";
        }

        .home-events-heading h2 {
            margin-bottom: 12px;
            color: #172033;
            font-size: clamp(32px, 4vw, 48px);
            line-height: 1.15;
        }

        .home-events-heading p {
            color: #6b7280;
            line-height: 1.75;
        }

        .home-events-grid {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 1.25fr 0.75fr;
            gap: 24px;
        }

        .home-event-featured {
            position: relative;
            min-height: 520px;
            overflow: hidden;
            border-radius: 30px;
            background: #12355b;
        }

        .home-event-featured img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }

        .home-event-featured:hover img {
            transform: scale(1.05);
        }

        .home-event-featured::after {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(
                    to top,
                    rgba(12, 34, 57, 0.95) 0%,
                    rgba(12, 34, 57, 0.35) 55%,
                    rgba(12, 34, 57, 0.08) 100%
                );
            content: "";
        }

        .home-event-featured-placeholder {
            position: absolute;
            inset: 0;
            display: grid;
            place-items: center;
            background:
                linear-gradient(
                    135deg,
                    #12355b,
                    #256b8f
                );
            color: rgba(255, 255, 255, 0.2);
            font-size: 100px;
            font-weight: 900;
        }

        .home-event-featured-content {
            position: absolute;
            z-index: 2;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 38px;
            color: white;
        }

        .home-event-featured-content h3 {
            max-width: 600px;
            margin: 16px 0 10px;
            color: white;
            font-size: clamp(25px, 3vw, 35px);
            line-height: 1.25;
        }

        .home-event-featured-content p {
            max-width: 600px;
            color: rgba(255, 255, 255, 0.78);
            line-height: 1.7;
        }

        .home-event-date-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 13px;
            border-radius: 20px;
            background: #f59e0b;
            color: #172033;
            font-size: 12px;
            font-weight: 800;
        }

        .home-event-featured-link {
            display: inline-flex;
            margin-top: 18px;
            color: #fbbf24;
            font-weight: 800;
            text-decoration: none;
        }

        .home-events-secondary {
            display: grid;
            align-content: start;
            gap: 20px;
        }

        .home-event-small {
            display: grid;
            grid-template-columns: 145px 1fr;
            min-height: 190px;
            overflow: hidden;
            border-radius: 24px;
            background: white;
            box-shadow: 0 12px 30px rgba(18, 53, 91, 0.08);
            transition: transform 0.25s;
        }

        .home-event-small:hover {
            transform: translateY(-5px);
        }

        .home-event-small-image {
            position: relative;
            min-height: 190px;
            overflow: hidden;
            background: #eaf4ff;
        }

        .home-event-small-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .home-event-small-placeholder {
            display: grid;
            width: 100%;
            height: 100%;
            place-items: center;
            background:
                linear-gradient(
                    135deg,
                    #dbeafe,
                    #fef3c7
                );
            color: #12355b;
            font-size: 28px;
            font-weight: 900;
        }

        .home-event-small-content {
            padding: 22px 19px;
        }

        .home-event-small-date {
            color: #ef6a5b;
            font-size: 12px;
            font-weight: 800;
        }

        .home-event-small h3 {
            margin: 10px 0 8px;
            color: #172033;
            font-size: 18px;
            line-height: 1.35;
        }

        .home-event-small-meta {
            color: #6b7280;
            font-size: 12px;
            line-height: 1.5;
        }

        .home-event-small-link {
            display: inline-flex;
            margin-top: 13px;
            color: #12355b;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
        }

        @media (max-width: 950px) {
            .home-events-wrapper {
                padding: 50px 35px;
            }

            .home-events-grid {
                grid-template-columns: 1fr;
            }

            .home-events-secondary {
                grid-template-columns: repeat(2, 1fr);
            }

            .home-event-small {
                grid-template-columns: 1fr;
            }

            .home-event-small-image {
                height: 190px;
            }
        }

        @media (max-width: 650px) {
            .home-events-section {
                padding: 70px 12px;
            }

            .home-events-wrapper {
                padding: 40px 20px;
                border-radius: 28px;
            }

            .home-events-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .home-event-featured {
                min-height: 470px;
            }

            .home-event-featured-content {
                padding: 27px 22px;
            }

            .home-events-secondary {
                grid-template-columns: 1fr;
            }

            .home-event-small {
                grid-template-columns: 120px 1fr;
            }

            .home-event-small-image {
                height: auto;
                min-height: 180px;
            }
        }

        @media (max-width: 430px) {
            .home-event-small {
                grid-template-columns: 1fr;
            }

            .home-event-small-image {
                height: 190px;
            }
        }

        @media (max-width: 850px) {
            .identity-wrapper {
                padding: 48px 30px;
                border-radius: 34px;
            }

            .identity-grid {
                grid-template-columns: 1fr;
            }

            .vision-panel {
                min-height: auto;
            }
        }

        @media (max-width: 520px) {
            .identity-section {
                padding: 70px 12px;
            }

            .identity-wrapper {
                padding: 38px 20px;
                border-radius: 26px;
            }

            .vision-panel,
            .mission-panel {
                padding: 26px 20px;
                border-radius: 22px;
            }

            .identity-heading h2 {
                font-size: 31px;
            }
        }

        @media (max-width: 620px) {
            .home-news-grid {
                grid-template-columns: 1fr;
            }
        }

        .founders-section {
            position: relative;
            padding: 105px 24px;
            overflow: hidden;
            background: #ffffff;
        }

        .founders-wrapper {
            position: relative;
            overflow: hidden;
            padding: 75px 65px;
            border-radius: 50px;
            background:
                linear-gradient(
                    145deg,
                    #eaf4ff 0%,
                    #f3f8ff 55%,
                    #fff8ed 100%
                );
        }

        .founders-wrapper::before {
            position: absolute;
            top: -90px;
            left: -70px;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: rgba(239, 106, 91, 0.16);
            content: "";
        }

        .founders-wrapper::after {
            position: absolute;
            right: -80px;
            bottom: -100px;
            width: 270px;
            height: 270px;
            border: 55px solid rgba(18, 53, 91, 0.07);
            border-radius: 50%;
            content: "";
        }

        .founders-heading {
            position: relative;
            z-index: 2;
            max-width: 720px;
            margin: 0 auto 48px;
            text-align: center;
        }

        .founders-label {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 14px;
            color: #ef6a5b;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        .founders-heading h2 {
            margin-bottom: 14px;
            color: #172033;
            font-size: clamp(32px, 4vw, 48px);
            line-height: 1.15;
        }

        .founders-heading p {
            color: #6b7280;
            line-height: 1.75;
        }

        .founders-grid {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
        }

        .founder-card {
            position: relative;
            overflow: hidden;
            border-radius: 28px;
            background: white;
            box-shadow: 0 15px 40px rgba(18, 53, 91, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .founder-card:nth-child(3n + 2) {
            transform: translateY(22px);
        }

        .founder-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 23px 48px rgba(18, 53, 91, 0.17);
        }

        .founder-card:nth-child(3n + 2):hover {
            transform: translateY(15px);
        }

        .founder-photo-wrapper {
            position: relative;
            height: 330px;
            overflow: hidden;
            background: #dbeafe;
        }

        .founder-photo-wrapper::after {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            height: 45%;
            background:
                linear-gradient(
                    to top,
                    rgba(18, 53, 91, 0.35),
                    transparent
                );
            content: "";
        }

        .founder-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
            transition: transform 0.45s;
        }

        .founder-card:hover .founder-photo {
            transform: scale(1.05);
        }

        .founder-photo-placeholder {
            display: grid;
            width: 100%;
            height: 100%;
            place-items: center;
            background:
                linear-gradient(
                    135deg,
                    #12355b,
                    #256b8f
                );
            color: rgba(255, 255, 255, 0.8);
            font-size: 60px;
            font-weight: 900;
        }

        .founder-order {
            position: absolute;
            z-index: 2;
            top: 18px;
            right: 18px;
            display: grid;
            width: 43px;
            height: 43px;
            place-items: center;
            border-radius: 14px;
            background: #f59e0b;
            color: #172033;
            font-size: 12px;
            font-weight: 900;
        }

        .founder-content {
            position: relative;
            padding: 26px;
        }

        .founder-content::before {
            position: absolute;
            top: 0;
            left: 26px;
            width: 45px;
            height: 4px;
            border-radius: 5px;
            background: #ef6a5b;
            content: "";
        }

        .founder-position {
            display: block;
            margin-bottom: 8px;
            color: #ef6a5b;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .founder-content h3 {
            margin-bottom: 10px;
            color: #172033;
            font-size: 22px;
        }

        .founder-biography {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.7;
        }

        .founder-year {
            display: inline-flex;
            margin-top: 15px;
            padding: 7px 11px;
            border-radius: 20px;
            background: #fff8ed;
            color: #92400e;
            font-size: 11px;
            font-weight: 800;
        }

        .founder-socials {
            display: flex;
            gap: 9px;
            margin-top: 17px;
        }

        .founder-social-link {
            display: inline-flex;
            padding: 8px 11px;
            border-radius: 10px;
            background: #eaf4ff;
            color: #12355b;
            font-size: 12px;
            font-weight: 800;
            text-decoration: none;
            transition: 0.2s;
        }

        .founder-social-link:hover {
            background: #12355b;
            color: white;
        }

        @media (max-width: 950px) {
            .founders-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .founder-card:nth-child(3n + 2) {
                transform: none;
            }

            .founder-card:hover,
            .founder-card:nth-child(3n + 2):hover {
                transform: translateY(-7px);
            }
        }

        @media (max-width: 650px) {
            .founders-section {
                padding: 70px 12px;
            }

            .founders-wrapper {
                padding: 48px 20px;
                border-radius: 30px;
            }

            .founders-grid {
                grid-template-columns: 1fr;
            }

            .founder-photo-wrapper {
                height: 350px;
            }
        }

        .home-campaign-section {
            position: relative;
            padding: 105px 24px;
            overflow: hidden;
            background: #ffffff;
        }

        .home-campaign-wrapper {
            position: relative;
            overflow: hidden;
            padding: 75px 65px;
            border-radius: 50px;
            background:
                linear-gradient(
                    145deg,
                    #eaf4ff,
                    #f4f8ff
                );
        }

        .home-campaign-wrapper::before {
            position: absolute;
            top: -100px;
            right: -75px;
            width: 280px;
            height: 280px;
            border: 55px solid rgba(18, 53, 91, 0.06);
            border-radius: 50%;
            content: "";
        }

        .home-campaign-wrapper::after {
            position: absolute;
            bottom: -120px;
            left: -80px;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: rgba(239, 106, 91, 0.1);
            content: "";
        }

        .home-campaign-heading {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 35px;
            margin-bottom: 43px;
        }

        .home-campaign-heading-content {
            max-width: 680px;
        }

        .home-campaign-label {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 13px;
            color: #ef6a5b;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 1.4px;
            text-transform: uppercase;
        }

        .home-campaign-label::before {
            width: 30px;
            height: 3px;
            border-radius: 5px;
            background: #ef6a5b;
            content: "";
        }

        .home-campaign-heading h2 {
            margin-bottom: 12px;
            color: #172033;
            font-size: clamp(32px, 4vw, 48px);
            line-height: 1.15;
        }

        .home-campaign-heading p {
            color: #6b7280;
            line-height: 1.75;
        }

        .home-campaign-wrapper .campaign-grid {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .home-campaign-wrapper .campaign-card {
            overflow: hidden;
            border: 0;
            border-radius: 26px;
            background: white;
            box-shadow: 0 14px 38px rgba(18, 53, 91, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .home-campaign-wrapper .campaign-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 23px 48px rgba(18, 53, 91, 0.17);
        }

        .home-campaign-wrapper .campaign-image {
            position: relative;
            height: 235px;
            overflow: hidden;
        }

        .home-campaign-wrapper .campaign-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.45s;
        }

        .home-campaign-wrapper .campaign-card:hover img {
            transform: scale(1.06);
        }

        .home-campaign-wrapper .category-badge {
            position: absolute;
            top: 17px;
            left: 17px;
            padding: 7px 11px;
            border-radius: 20px;
            background: #f59e0b;
            color: #172033;
            font-size: 11px;
            font-weight: 800;
        }

        .home-campaign-wrapper .campaign-content {
            padding: 25px;
        }

        .home-campaign-wrapper .campaign-content > a {
            color: inherit;
            text-decoration: none;
        }

        .home-campaign-wrapper .campaign-content h3 {
            min-height: 58px;
            margin-bottom: 11px;
            color: #172033;
            font-size: 21px;
            line-height: 1.4;
        }

        .home-campaign-wrapper .campaign-content > p {
            min-height: 68px;
            color: #6b7280;
            font-size: 14px;
            line-height: 1.65;
        }

        .home-campaign-wrapper .progress {
            height: 9px;
            margin: 20px 0 17px;
            overflow: hidden;
            border-radius: 20px;
            background: #e5e7eb;
        }

        .home-campaign-wrapper .progress-bar {
            height: 100%;
            border-radius: 20px;
            background:
                linear-gradient(
                    90deg,
                    #ef6a5b,
                    #f59e0b
                );
        }

        .home-campaign-wrapper .campaign-nominal {
            display: flex;
            justify-content: space-between;
            gap: 15px;
        }

        .home-campaign-wrapper .campaign-nominal strong,
        .home-campaign-wrapper .campaign-nominal span {
            display: block;
        }

        .home-campaign-wrapper .campaign-nominal strong {
            color: #172033;
            font-size: 14px;
        }

        .home-campaign-wrapper .campaign-nominal span {
            margin-top: 4px;
            color: #9ca3af;
            font-size: 11px;
        }

        .home-campaign-wrapper .campaign-target {
            text-align: right;
        }

        .home-campaign-wrapper .campaign-footer .btn {
            border-color: #12355b;
            background: #12355b;
            color: white;
        }

        .home-campaign-wrapper .campaign-footer .btn:hover {
            background: #0c2947;
        }

        .home-campaign-all {
            position: relative;
            z-index: 2;
            margin-top: 38px;
            text-align: center;
        }

        .home-campaign-all .btn {
            border-color: #12355b;
            color: #12355b;
        }

        @media (max-width: 1000px) {
            .home-campaign-wrapper .campaign-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 700px) {
            .home-campaign-section {
                padding: 70px 12px;
            }

            .home-campaign-wrapper {
                padding: 48px 20px;
                border-radius: 30px;
            }

            .home-campaign-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .home-campaign-wrapper .campaign-grid {
                grid-template-columns: 1fr;
            }

            .home-campaign-wrapper .campaign-content h3,
            .home-campaign-wrapper .campaign-content > p {
                min-height: auto;
            }
        }

            .home-about-section {
                position: relative;
                padding: 105px 24px;
                overflow: hidden;
                background: #ffffff;
            }

            .home-about-wrapper {
                position: relative;
                display: grid;
                grid-template-columns: 0.95fr 1.05fr;
                align-items: center;
                gap: 70px;
                padding: 70px;
                border-radius: 48px;
                background: #fff8ed;
            }

            .home-about-wrapper::before {
                position: absolute;
                top: -80px;
                right: -60px;
                width: 230px;
                height: 230px;
                border-radius: 50%;
                background: rgba(245, 158, 11, 0.14);
                content: "";
            }

            .home-about-visual {
                position: relative;
                min-height: 500px;
            }

            .home-about-image-frame {
                position: absolute;
                inset: 0 30px 30px 0;
                overflow: hidden;
                border-radius: 32px;
                background: #12355b;
                box-shadow: 0 25px 55px rgba(18, 53, 91, 0.18);
            }

            .home-about-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .home-about-placeholder {
                display: grid;
                width: 100%;
                height: 100%;
                place-items: center;
                background: linear-gradient(
                    135deg,
                    #12355b,
                    #256b8f
                );
                color: rgba(255, 255, 255, 0.25);
                font-size: 90px;
                font-weight: 900;
            }

            .home-about-accent {
                position: absolute;
                right: 0;
                bottom: 0;
                width: 190px;
                padding: 23px;
                border: 7px solid #fff8ed;
                border-radius: 25px;
                background: #ef6a5b;
                color: white;
                box-shadow: 0 18px 40px rgba(239, 106, 91, 0.25);
            }

            .home-about-accent strong,
            .home-about-accent span {
                display: block;
            }

            .home-about-accent strong {
                margin-bottom: 7px;
                font-size: 25px;
                line-height: 1.2;
            }

            .home-about-accent span {
                color: rgba(255, 255, 255, 0.82);
                font-size: 13px;
                line-height: 1.5;
            }

            .home-about-content {
                position: relative;
                z-index: 2;
            }

            .home-about-label {
                display: inline-flex;
                align-items: center;
                gap: 9px;
                margin-bottom: 15px;
                color: #ef6a5b;
                font-size: 13px;
                font-weight: 800;
                letter-spacing: 1.4px;
                text-transform: uppercase;
            }

            .home-about-label::before {
                width: 30px;
                height: 3px;
                border-radius: 5px;
                background: #ef6a5b;
                content: "";
            }

            .home-about-content h2 {
                margin-bottom: 20px;
                color: #172033;
                font-size: clamp(32px, 4vw, 48px);
                line-height: 1.15;
            }

            .home-about-description {
                color: #5f6878;
                font-size: 16px;
                line-height: 1.85;
            }

            .home-about-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                margin-top: 28px;
            }

            .home-about-primary {
                border-color: #12355b;
                background: #12355b;
                color: white;
            }

            .home-about-primary:hover {
                background: #0c2947;
            }

            .home-about-secondary {
                border-color: #ef6a5b;
                color: #ef6a5b;
            }

            @media (max-width: 900px) {
                .home-about-wrapper {
                    grid-template-columns: 1fr;
                    gap: 50px;
                    padding: 50px 35px;
                }

                .home-about-visual {
                    min-height: 450px;
                }
            }

            @media (max-width: 600px) {
                .home-about-section {
                    padding: 70px 12px;
                }

                .home-about-wrapper {
                    padding: 35px 20px;
                    border-radius: 28px;
                }

                .home-about-visual {
                    min-height: 390px;
                }

                .home-about-image-frame {
                    inset: 0 15px 45px 0;
                    border-radius: 24px;
                }

                .home-about-accent {
                    width: 165px;
                    padding: 18px;
                    border-width: 5px;
                }

                .home-about-accent strong {
                    font-size: 21px;
                }

                .home-about-actions {
                    flex-direction: column;
                }

                .home-about-actions .btn {
                    width: 100%;
                }
            }

            .home-cta-section {
                padding: 30px 24px 110px;
                background: #ffffff;
            }

            .home-cta-wrapper {
                position: relative;
                display: grid;
                grid-template-columns: 1fr auto;
                align-items: center;
                gap: 45px;
                overflow: hidden;
                padding: 70px;
                border-radius: 48px;
                background: linear-gradient(
                    135deg,
                    #ef6a5b,
                    #f59e0b
                );
                color: white;
                box-shadow: 0 25px 60px rgba(239, 106, 91, 0.2);
            }

            .home-cta-wrapper::before {
                position: absolute;
                top: -140px;
                right: 180px;
                width: 300px;
                height: 300px;
                border: 60px solid rgba(255, 255, 255, 0.1);
                border-radius: 50%;
                content: "";
            }

            .home-cta-wrapper::after {
                position: absolute;
                right: -100px;
                bottom: -160px;
                width: 330px;
                height: 330px;
                border-radius: 50%;
                background: rgba(18, 53, 91, 0.13);
                content: "";
            }

            .home-cta-content {
                position: relative;
                z-index: 2;
                max-width: 750px;
            }

            .home-cta-label {
                display: inline-flex;
                margin-bottom: 15px;
                padding: 7px 12px;
                border: 1px solid rgba(255, 255, 255, 0.35);
                border-radius: 20px;
                background: rgba(255, 255, 255, 0.12);
                color: white;
                font-size: 12px;
                font-weight: 800;
                letter-spacing: 1px;
                text-transform: uppercase;
            }

            .home-cta-content h2 {
                margin-bottom: 15px;
                color: white;
                font-size: clamp(32px, 4.5vw, 52px);
                line-height: 1.12;
            }

            .home-cta-content p {
                max-width: 650px;
                color: rgba(255, 255, 255, 0.88);
                font-size: 17px;
                line-height: 1.75;
            }

            .home-cta-actions {
                position: relative;
                z-index: 2;
                display: grid;
                min-width: 220px;
                gap: 12px;
            }

            .home-cta-primary,
            .home-cta-secondary {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-height: 51px;
                padding: 13px 20px;
                border-radius: 13px;
                font-weight: 800;
                text-decoration: none;
                transition: 0.25s;
            }

            .home-cta-primary {
                background: #12355b;
                color: white;
                box-shadow: 0 12px 28px rgba(18, 53, 91, 0.25);
            }

            .home-cta-primary:hover {
                transform: translateY(-3px);
                background: #0c2947;
            }

            .home-cta-secondary {
                border: 1px solid rgba(255, 255, 255, 0.55);
                background: rgba(255, 255, 255, 0.13);
                color: white;
            }

            .home-cta-secondary:hover {
                background: white;
                color: #12355b;
            }

            @media (max-width: 800px) {
                .home-cta-wrapper {
                    grid-template-columns: 1fr;
                    padding: 50px 35px;
                }

                .home-cta-actions {
                    grid-template-columns: repeat(2, 1fr);
                    min-width: 0;
                }
            }

            @media (max-width: 550px) {
                .home-cta-section {
                    padding: 20px 12px 75px;
                }

                .home-cta-wrapper {
                    padding: 42px 22px;
                    border-radius: 28px;
                }

                .home-cta-actions {
                    grid-template-columns: 1fr;
                }
            }

            .home-campaign-donate {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 9px;
                width: 100%;
                min-height: 50px;
                padding: 13px 20px;
                border: none;
                border-radius: 13px;
                background: #12355b;
                color: #ffffff;
                font-size: 14px;
                font-weight: 800;
                line-height: 1.2;
                text-align: center;
                text-decoration: none;
                box-shadow: 0 10px 24px rgba(18, 53, 91, 0.18);
                transition:
                    transform 0.25s,
                    background-color 0.25s,
                    box-shadow 0.25s;
            }

            .home-campaign-donate:hover {
                transform: translateY(-2px);
                background: #ef6a5b;
                color: #ffffff;
                box-shadow: 0 14px 28px rgba(239, 106, 91, 0.24);
            }

            .home-campaign-donate:focus {
                color: #ffffff;
                outline: 3px solid rgba(245, 158, 11, 0.4);
                outline-offset: 3px;
            }

            .home-campaign-donate span {
                transition: transform 0.25s;
            }

            .home-campaign-donate:hover span {
                transform: translateX(4px);
            }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section
        class="hero"
        <?php if($setting?->hero_image): ?>
            style="
                background-image:
                    url('<?php echo e(asset(
                        'storage/' . $setting->hero_image
                    )); ?>');
            "
        <?php endif; ?>
    >
        <div class="container hero-grid">
            <div class="hero-content">
                <span class="hero-label">
                    <?php echo e($setting?->organization_name
                        ?: 'Yayasan Harapan Bangsa'); ?>

                </span>

                <h1>
                    <?php echo e($setting?->tagline
                        ?: 'Berbagi Kebaikan, Menumbuhkan Harapan'); ?>

                </h1>

                <p class="hero-description">
                    <?php echo e($setting?->short_description
                        ?: 'Mari bersama membantu memenuhi kebutuhan, pendidikan, dan masa depan anak-anak Harapan Bangsa.'); ?>

                </p>

                <div class="hero-actions">
                    <a
                        href="<?php echo e(route('campaigns.index')); ?>"
                        class="btn-hero-primary"
                    >
                        Donasi Sekarang →
                    </a>

                    <a
                        href="#campaign"
                        class="btn-hero-secondary"
                    >
                        Lihat Campaign
                    </a>
                </div>
            </div>

            <aside class="hero-message-card">
                <span class="hero-message-accent">
                    “
                </span>

                <div class="hero-message-icon">
                    ♥
                </div>

                <h2>
                    Kebaikanmu Sangat Berarti
                </h2>

                <p>
                    Setiap bantuan menjadi langkah berharga untuk
                    membuka kesempatan dan masa depan yang lebih baik.
                </p>
            </aside>
        </div>
    </section>

    <section class="statistics-section">
        <div class="container">
            <div class="statistics-wrapper">
                <div class="statistics-grid">
                    <article class="statistic">
                        <div class="statistic-top">
                            <div class="statistic-icon">
                                ◆
                            </div>

                            <div>
                                <strong>
                                    <?php echo e(number_format(
                                        $statistics['campaigns'],
                                        0,
                                        ',',
                                        '.'
                                    )); ?>

                                </strong>

                                <span>Campaign Aktif</span>
                            </div>
                        </div>
                    </article>

                    <article class="statistic">
                        <div class="statistic-top">
                            <div class="statistic-icon">
                                ♥
                            </div>

                            <div>
                                <strong>
                                    <?php echo e(number_format(
                                        $statistics['donations'],
                                        0,
                                        ',',
                                        '.'
                                    )); ?>

                                </strong>

                                <span>Donasi Berhasil</span>
                            </div>
                        </div>
                    </article>

                    <article class="statistic">
                        <div class="statistic-top">
                            <div class="statistic-icon">
                                Rp
                            </div>

                            <div>
                                <strong>
                                    Rp <?php echo e(number_format(
                                        $statistics['collected'],
                                        0,
                                        ',',
                                        '.'
                                    )); ?>

                                </strong>

                                <span>Dana Terkumpul</span>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <?php if($setting?->about): ?>
        <section class="home-about-section">
            <div class="container">
                <div class="home-about-wrapper">
                    <div class="home-about-visual">
                        <div class="home-about-image-frame">
                            <?php if($setting->about_image): ?>
                                <img
                                    src="<?php echo e(asset(
                                        'storage/' .
                                        $setting->about_image
                                    )); ?>"
                                    alt="Tentang <?php echo e($setting->organization_name); ?>"
                                    class="home-about-image"
                                >
                            <?php else: ?>
                                <div class="home-about-placeholder">
                                    HB
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="home-about-accent">
                            <strong>
                                Bersama untuk Mereka
                            </strong>

                            <span>
                                Menghadirkan harapan melalui tindakan nyata.
                            </span>
                        </div>
                    </div>

                    <div class="home-about-content">
                        <span class="home-about-label">
                            Tentang Kami
                        </span>

                        <h2>
                            Mengenal <?php echo e($setting->organization_name
                                ?: 'Harapan Bangsa'); ?>

                        </h2>

                        <p class="home-about-description">
                            <?php echo e(Str::limit(
                                strip_tags($setting->about),
                                550
                            )); ?>

                        </p>

                        <div class="home-about-actions">
                            <a
                                href="<?php echo e(route('about')); ?>"
                                class="btn home-about-primary"
                            >
                                Selengkapnya →
                            </a>

                            <a
                                href="<?php echo e(route('campaigns.index')); ?>"
                                class="btn btn-outline home-about-secondary"
                            >
                                Lihat Campaign
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if($setting?->vision || $setting?->mission): ?>
    <section class="identity-section">
        <div class="container">
            <div class="identity-wrapper">
                <div class="identity-heading">
                    <span class="identity-label">
                        Identitas Kami
                    </span>

                    <h2>
                        Bergerak Bersama untuk Masa Depan Mereka
                    </h2>

                    <p>
                        Visi dan misi menjadi dasar setiap langkah
                        Harapan Bangsa dalam memberikan pelayanan,
                        perhatian, dan kesempatan yang lebih baik.
                    </p>
                </div>

                <div class="identity-grid">
                    <?php if($setting->vision): ?>
                        <article class="vision-panel">
                            <div class="vision-icon">
                                ◎
                            </div>

                            <div>
                                <h3>Visi Kami</h3>

                                <p>
                                    <?php echo e($setting->vision); ?>

                                </p>
                            </div>
                        </article>
                    <?php endif; ?>

                    <?php if($setting->mission): ?>
                        <?php
                            $missions = collect(
                                preg_split(
                                    '/\r\n|\r|\n/',
                                    $setting->mission
                                )
                            )
                                ->map(fn ($mission) => trim($mission))
                                ->filter();
                        ?>

                        <article class="mission-panel">
                            <h3>Misi Kami</h3>

                            <ul class="mission-list">
                                <?php $__currentLoopData = $missions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="mission-item">
                                        <span class="mission-number">
                                            <?php echo e(str_pad(
                                                $loop->iteration,
                                                2,
                                                '0',
                                                STR_PAD_LEFT
                                            )); ?>

                                        </span>

                                        <span><?php echo e($mission); ?></span>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </article>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

    <section class="home-campaign-section" id="campaign">
        <div class="container">
            <div class="home-campaign-wrapper">
                <div class="home-campaign-heading">
                    <div class="home-campaign-heading-content">
                        <span class="home-campaign-label">
                            Campaign Pilihan
                        </span>

                        <h2>
                            Mari Hadirkan Perubahan Bersama
                        </h2>

                        <p>
                            Pilih campaign yang ingin kamu dukung dan
                            jadilah bagian dari perubahan yang berarti.
                        </p>
                    </div>

                    <a
                        href="<?php echo e(route('campaigns.index')); ?>"
                        class="btn btn-primary"
                    >
                        Semua Campaign
                    </a>
                </div>

                <div class="campaign-grid">
                    <?php $__empty_1 = true; $__currentLoopData = $featuredCampaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campaign): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $collected =
                                $campaign->collected_amount ?? 0;

                            $percentage =
                                $campaign->target_amount > 0
                                    ? min(
                                        (
                                            $collected
                                            / $campaign->target_amount
                                        ) * 100,
                                        100
                                    )
                                    : 0;
                        ?>

                        <article class="campaign-card">
                            <a
                                href="<?php echo e(route(
                                    'campaigns.show',
                                    $campaign->slug
                                )); ?>"
                            >
                                <div class="campaign-image">
                                    <img
                                        src="<?php echo e(asset(
                                            'storage/' .
                                            $campaign->thumbnail
                                        )); ?>"
                                        alt="<?php echo e($campaign->title); ?>"
                                    >

                                    <span class="category-badge">
                                        <?php echo e($campaign->category?->name ?? 'Umum'); ?>

                                    </span>
                                </div>
                            </a>

                            <div class="campaign-content">
                                <a
                                    href="<?php echo e(route(
                                        'campaigns.show',
                                        $campaign->slug
                                    )); ?>"
                                >
                                    <h3>
                                        <?php echo e($campaign->title); ?>

                                    </h3>
                                </a>

                                <p>
                                    <?php echo e(Str::limit(
                                        $campaign->short_description,
                                        100
                                    )); ?>

                                </p>

                                <div class="progress">
                                    <div
                                        class="progress-bar"
                                        style="
                                            width: <?php echo e(number_format(
                                                    $percentage,
                                                    2,
                                                    '.',
                                                    ''
                                                )); ?>%;
                                        "
                                    ></div>
                                </div>

                                <div class="campaign-nominal">
                                    <div>
                                        <strong>
                                            Rp <?php echo e(number_format(
                                                $collected,
                                                0,
                                                ',',
                                                '.'
                                            )); ?>

                                        </strong>

                                        <span>Terkumpul</span>
                                    </div>

                                    <div class="campaign-target">
                                        <strong>
                                            Rp <?php echo e(number_format(
                                                $campaign->target_amount,
                                                0,
                                                ',',
                                                '.'
                                            )); ?>

                                        </strong>

                                        <span>Target</span>
                                    </div>
                                </div>

                                <div class="campaign-footer">
                                    <a
                                        href="<?php echo e(route(
                                            'campaigns.show',
                                            $campaign->slug
                                        )); ?>"
                                        class="home-campaign-donate"
                                    >
                                        Donasi Sekarang
                                        <span aria-hidden="true">→</span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="empty-state">
                            Belum ada campaign yang dipublikasikan.
                        </div>
                    <?php endif; ?>
                </div>

                <?php if($featuredCampaigns->isNotEmpty()): ?>
                    <div class="home-campaign-all">
                        <a
                            href="<?php echo e(route('campaigns.index')); ?>"
                            class="btn btn-outline"
                        >
                            Lihat Semua Campaign →
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php if($latestEvents->isNotEmpty()): ?>
        <?php
            $primaryEvent = $latestEvents->first();
            $secondaryEvents = $latestEvents->skip(1);
        ?>

        <section class="home-events-section">
            <div class="container">
                <div class="home-events-wrapper">
                    <div class="home-events-heading">
                        <div class="home-events-heading-content">
                            <span class="home-events-label">
                                Acara & Kegiatan
                            </span>

                            <h2>
                                Hadir, Bergerak, dan Bertumbuh Bersama
                            </h2>

                            <p>
                                Ikuti berbagai kegiatan sosial, pendidikan,
                                dan kebersamaan yang diselenggarakan oleh
                                Yayasan Harapan Bangsa.
                            </p>
                        </div>

                        <a
                            href="<?php echo e(route('events.index')); ?>"
                            class="btn btn-primary"
                        >
                            Lihat Semua Acara
                        </a>
                    </div>

                    <div class="home-events-grid">
                        <article class="home-event-featured">
                            <?php if($primaryEvent->thumbnail): ?>
                                <img
                                    src="<?php echo e(asset(
                                        'storage/' .
                                        $primaryEvent->thumbnail
                                    )); ?>"
                                    alt="<?php echo e($primaryEvent->title); ?>"
                                >
                            <?php else: ?>
                                <div
                                    class="home-event-featured-placeholder"
                                >
                                    HB
                                </div>
                            <?php endif; ?>

                            <div class="home-event-featured-content">
                                <span class="home-event-date-badge">
                                    <?php echo e($primaryEvent->event_date
                                        ->translatedFormat('d F Y')); ?>

                                </span>

                                <h3>
                                    <?php echo e($primaryEvent->title); ?>

                                </h3>

                                <p>
                                    <?php echo e(Str::limit(
                                        $primaryEvent->short_description
                                            ?: strip_tags(
                                                $primaryEvent->description
                                            ),
                                        150
                                    )); ?>

                                </p>

                                <a
                                    href="<?php echo e(route(
                                        'events.show',
                                        $primaryEvent
                                    )); ?>"
                                    class="home-event-featured-link"
                                >
                                    Lihat Detail Acara →
                                </a>
                            </div>
                        </article>

                        <?php if($secondaryEvents->isNotEmpty()): ?>
                            <div class="home-events-secondary">
                                <?php $__currentLoopData = $secondaryEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <article class="home-event-small">
                                        <div class="home-event-small-image">
                                            <?php if($event->thumbnail): ?>
                                                <img
                                                    src="<?php echo e(asset(
                                                        'storage/' .
                                                        $event->thumbnail
                                                    )); ?>"
                                                    alt="<?php echo e($event->title); ?>"
                                                >
                                            <?php else: ?>
                                                <div
                                                    class="home-event-small-placeholder"
                                                >
                                                    HB
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="home-event-small-content">
                                            <span class="home-event-small-date">
                                                <?php echo e($event->event_date
                                                    ->translatedFormat(
                                                        'd M Y'
                                                    )); ?>

                                            </span>

                                            <h3>
                                                <?php echo e(Str::limit(
                                                    $event->title,
                                                    55
                                                )); ?>

                                            </h3>

                                            <?php if($event->location): ?>
                                                <div
                                                    class="home-event-small-meta"
                                                >
                                                    <?php echo e($event->location); ?>

                                                </div>
                                            <?php endif; ?>

                                            <a
                                                href="<?php echo e(route(
                                                    'events.show',
                                                    $event
                                                )); ?>"
                                                class="home-event-small-link"
                                            >
                                                Lihat Detail →
                                            </a>
                                        </div>
                                    </article>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if($founders->isNotEmpty()): ?>
        <section class="founders-section">
            <div class="container">
                <div class="founders-wrapper">
                    <div class="founders-heading">
                        <span class="founders-label">
                            Sosok di Balik Harapan
                        </span>

                        <h2>Pendiri Yayasan Harapan Bangsa</h2>

                        <p>
                            Mengenal orang-orang yang mengawali perjalanan
                            dan terus menggerakkan pelayanan Yayasan
                            Harapan Bangsa.
                        </p>
                    </div>

                    <div class="founders-grid">
                        <?php $__currentLoopData = $founders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $founder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <article class="founder-card">
                                <div class="founder-photo-wrapper">
                                    <?php if($founder->photo): ?>
                                        <img
                                            src="<?php echo e(asset(
                                                'storage/' .
                                                $founder->photo
                                            )); ?>"
                                            alt="<?php echo e($founder->name); ?>"
                                            class="founder-photo"
                                        >
                                    <?php else: ?>
                                        <div
                                            class="founder-photo-placeholder"
                                        >
                                            <?php echo e(strtoupper(
                                                substr(
                                                    $founder->name,
                                                    0,
                                                    2
                                                )
                                            )); ?>

                                        </div>
                                    <?php endif; ?>

                                    <span class="founder-order">
                                        <?php echo e(str_pad(
                                            $loop->iteration,
                                            2,
                                            '0',
                                            STR_PAD_LEFT
                                        )); ?>

                                    </span>
                                </div>

                                <div class="founder-content">
                                    <?php if($founder->position): ?>
                                        <span class="founder-position">
                                            <?php echo e($founder->position); ?>

                                        </span>
                                    <?php endif; ?>

                                    <h3><?php echo e($founder->name); ?></h3>

                                    <?php if($founder->biography): ?>
                                        <p class="founder-biography">
                                            <?php echo e(Str::limit(
                                                $founder->biography,
                                                150
                                            )); ?>

                                        </p>
                                    <?php endif; ?>

                                    <?php if($founder->joined_year): ?>
                                        <span class="founder-year">
                                            Sejak <?php echo e($founder->joined_year); ?>

                                        </span>
                                    <?php endif; ?>

                                    <?php if(
                                        $founder->instagram_url
                                        || $founder->linkedin_url
                                    ): ?>
                                        <div class="founder-socials">
                                            <?php if($founder->instagram_url): ?>
                                                <a
                                                    href="<?php echo e($founder
                                                            ->instagram_url); ?>"
                                                    target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="founder-social-link"
                                                >
                                                    Instagram
                                                </a>
                                            <?php endif; ?>

                                            <?php if($founder->linkedin_url): ?>
                                                <a
                                                    href="<?php echo e($founder
                                                            ->linkedin_url); ?>"
                                                    target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="founder-social-link"
                                                >
                                                    LinkedIn
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </article>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if($latestNews->isNotEmpty()): ?>
        <?php
            $primaryNews = $latestNews->first();
            $secondaryNews = $latestNews->skip(1);
        ?>

        <section class="home-news-section">
            <div class="container">
                <div class="home-news-wrapper">
                    <div class="home-news-heading">
                        <div class="home-news-heading-content">
                            <span class="home-news-label">
                                Berita Terbaru
                            </span>

                            <h2>
                                Cerita dan Perjalanan Harapan Bangsa
                            </h2>

                            <p>
                                Ikuti kabar, kegiatan, dan cerita terbaru
                                dari pelayanan Yayasan Harapan Bangsa.
                            </p>
                        </div>

                        <a
                            href="<?php echo e(route('news.index')); ?>"
                            class="btn btn-outline home-news-all"
                        >
                            Semua Berita
                        </a>
                    </div>

                    <div class="home-news-layout">
                        <article class="home-news-featured">
                            <?php if($primaryNews->thumbnail): ?>
                                <img
                                    src="<?php echo e(asset(
                                        'storage/' .
                                        $primaryNews->thumbnail
                                    )); ?>"
                                    alt="<?php echo e($primaryNews->title); ?>"
                                >
                            <?php else: ?>
                                <div
                                    class="home-news-featured-placeholder"
                                >
                                    HB
                                </div>
                            <?php endif; ?>

                            <div class="home-news-featured-content">
                                <span class="home-news-featured-date">
                                    <?php echo e($primaryNews->published_at
                                        ->translatedFormat('d F Y')); ?>

                                </span>

                                <h3>
                                    <?php echo e($primaryNews->title); ?>

                                </h3>

                                <p>
                                    <?php echo e(Str::limit(
                                        $primaryNews->excerpt,
                                        155
                                    )); ?>

                                </p>

                                <a
                                    href="<?php echo e(route(
                                        'news.show',
                                        $primaryNews->slug
                                    )); ?>"
                                    class="home-news-featured-link"
                                >
                                    Baca Selengkapnya →
                                </a>
                            </div>
                        </article>

                        <?php if($secondaryNews->isNotEmpty()): ?>
                            <div class="home-news-secondary">
                                <?php $__currentLoopData = $secondaryNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <article class="home-news-small">
                                        <div class="home-news-small-image">
                                            <?php if($item->thumbnail): ?>
                                                <img
                                                    src="<?php echo e(asset(
                                                        'storage/' .
                                                        $item->thumbnail
                                                    )); ?>"
                                                    alt="<?php echo e($item->title); ?>"
                                                >
                                            <?php else: ?>
                                                <div
                                                    class="home-news-small-placeholder"
                                                >
                                                    HB
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="home-news-small-content">
                                            <span class="home-news-small-date">
                                                <?php echo e($item->published_at
                                                    ->translatedFormat(
                                                        'd M Y'
                                                    )); ?>

                                            </span>

                                            <h3>
                                                <?php echo e(Str::limit(
                                                    $item->title,
                                                    65
                                                )); ?>

                                            </h3>

                                            <p>
                                                <?php echo e(Str::limit(
                                                    $item->excerpt,
                                                    85
                                                )); ?>

                                            </p>

                                            <a
                                                href="<?php echo e(route(
                                                    'news.show',
                                                    $item->slug
                                                )); ?>"
                                                class="home-news-small-link"
                                            >
                                                Baca Berita →
                                            </a>
                                        </div>
                                    </article>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="home-cta-section">
        <div class="container">
            <div class="home-cta-wrapper">
                <div class="home-cta-content">
                    <span class="home-cta-label">
                        Mari Ambil Bagian
                    </span>

                    <h2>
                        Kebaikan Kecilmu Bisa Menjadi Harapan Besar
                    </h2>

                    <p>
                        Bersama <?php echo e($setting?->organization_name
                                ?: 'Harapan Bangsa'); ?>, setiap bantuan yang diberikan menjadi
                        langkah nyata untuk mendukung kebutuhan,
                        pendidikan, dan masa depan mereka.
                    </p>
                </div>

                <div class="home-cta-actions">
                    <a
                        href="<?php echo e(route('campaigns.index')); ?>"
                        class="home-cta-primary"
                    >
                        Donasi Sekarang →
                    </a>

                    <?php if($setting?->whatsapp_url): ?>
                        <a
                            href="<?php echo e($setting->whatsapp_url); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="home-cta-secondary"
                        >
                            Hubungi Kami
                        </a>
                    <?php else: ?>
                        <a
                            href="<?php echo e(route('contact')); ?>"
                            class="home-cta-secondary"
                        >
                            Hubungi Kami
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project\Laravel\harapan-bangsa\resources\views/frontend/home.blade.php ENDPATH**/ ?>