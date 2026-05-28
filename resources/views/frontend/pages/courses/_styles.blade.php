@once
@push('styles')
<style>
    .academic-page {
        position: relative;
        overflow: hidden;
    }

    .academic-shell {
        width: min(1120px, calc(100% - 32px));
        margin: 0 auto;
    }

    .academic-hero {
        padding: 72px 0 34px;
    }

    .academic-kicker {
        margin: 0 0 14px;
        color: #4f6f52;
        font-size: 12px;
        font-weight: 900;
        letter-spacing: .22em;
        text-transform: uppercase;
    }

    .dark .academic-kicker {
        color: #f3d998;
    }

    .academic-title {
        margin: 0;
        max-width: 780px;
        color: #18382c;
        font-size: clamp(42px, 6vw, 70px);
        line-height: .98;
        letter-spacing: -0.055em;
        font-weight: 950;
    }

    .dark .academic-title {
        color: #f6f1e8;
    }

    .academic-lead {
        margin: 20px 0 0;
        max-width: 760px;
        color: #6b6258;
        font-size: 17px;
        line-height: 1.85;
        font-weight: 600;
    }

    .dark .academic-lead {
        color: rgba(215, 206, 192, .72);
    }

    .academic-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 24px;
    }

    .academic-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 44px;
        padding: 0 22px;
        border-radius: 999px;
        border: 0;
        background: #18382c;
        color: #ffffff;
        text-decoration: none;
        font-size: 14px;
        font-weight: 800;
        line-height: 1;
        transition: transform .2s ease, background-color .2s ease, box-shadow .2s ease;
        cursor: pointer;
    }

    .academic-btn:hover {
        transform: translateY(-2px);
        background: #0f2a21;
        color: #ffffff;
        box-shadow: 0 14px 28px rgba(24, 56, 44, .16);
    }

    .academic-btn.secondary {
        border: 1px solid #e7ded1;
        background: rgba(255, 255, 255, .78);
        color: #18382c;
        box-shadow: none;
    }

    .academic-btn.secondary:hover {
        background: #ffffff;
        color: #18382c;
        border-color: rgba(79, 111, 82, .34);
        box-shadow: 0 10px 22px rgba(31, 41, 51, .06);
    }

    .dark .academic-btn {
        background: #e6c98f;
        color: #1f1a14;
    }

    .dark .academic-btn:hover {
        background: #f3d998;
        color: #1f1a14;
        box-shadow: 0 14px 28px rgba(243, 217, 152, .12);
    }

    .dark .academic-btn.secondary {
        border-color: rgba(255, 255, 255, .12);
        background: rgba(255, 255, 255, .06);
        color: #f6f1e8;
    }

    .dark .academic-btn.secondary:hover {
        background: rgba(255, 255, 255, .10);
        color: #f6f1e8;
    }

    .academic-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        padding: 20px 0 78px;
    }

    .academic-card {
        display: block;
        height: 100%;
        padding: 24px;
        border-radius: 24px;
        border: 1px solid #e7ded1;
        background: rgba(255, 255, 255, .78);
        box-shadow: 0 8px 24px rgba(31, 41, 51, .045);
        text-decoration: none;
        transition: .22s ease;
    }

    .academic-card:hover {
        transform: translateY(-3px);
        border-color: rgba(79, 111, 82, .34);
        box-shadow: 0 18px 44px rgba(31, 41, 51, .075);
    }

    .dark .academic-card {
        background: rgba(255, 255, 255, .06);
        border-color: rgba(255, 255, 255, .10);
        box-shadow: none;
    }

    .dark .academic-card:hover {
        background: rgba(255, 255, 255, .08);
    }

    .academic-card-title {
        margin: 14px 0 0;
        color: #18382c;
        font-size: 26px;
        line-height: 1.12;
        letter-spacing: -0.035em;
        font-weight: 950;
    }

    .dark .academic-card-title {
        color: #f6f1e8;
    }

    .academic-card-text {
        margin: 12px 0 0;
        color: #6b6258;
        font-size: 14px;
        line-height: 1.72;
        font-weight: 600;
    }

    .dark .academic-card-text {
        color: rgba(215, 206, 192, .68);
    }

    .academic-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 0;
    }

    .academic-chip {
        display: inline-flex;
        align-items: center;
        min-height: 28px;
        padding: 0 11px;
        border-radius: 999px;
        background: #eef3e8;
        color: #4f6f52;
        font-size: 12px;
        font-weight: 900;
    }

    .academic-chip.gold {
        background: #fbf4e7;
        color: #9a761c;
    }

    .academic-chip.muted {
        background: #f1f1ef;
        color: #6b6258;
    }

    .dark .academic-chip {
        background: rgba(79, 111, 82, .22);
        color: #dbe8d4;
    }

    .dark .academic-chip.gold {
        background: rgba(154, 118, 28, .22);
        color: #f3d998;
    }

    .dark .academic-chip.muted {
        background: rgba(255, 255, 255, .08);
        color: rgba(215, 206, 192, .72);
    }

    .academic-panel {
        border: 1px solid #e7ded1;
        border-radius: 24px;
        background: rgba(255, 255, 255, .78);
        box-shadow: 0 8px 24px rgba(31, 41, 51, .045);
    }

    .dark .academic-panel {
        background: rgba(255, 255, 255, .06);
        border-color: rgba(255, 255, 255, .10);
        box-shadow: none;
    }

    .academic-layout {
        display: grid;
        grid-template-columns: .78fr 1.22fr;
        gap: 18px;
        padding: 20px 0 78px;
    }

    .academic-side {
        padding: 24px;
        align-self: start;
        position: sticky;
        top: 96px;
    }

    .academic-main {
        padding: 24px;
    }

    .academic-section-title {
        margin: 0;
        color: #18382c;
        font-size: 34px;
        line-height: 1.05;
        letter-spacing: -0.04em;
        font-weight: 950;
    }

    .dark .academic-section-title {
        color: #f6f1e8;
    }

    .academic-readable {
        color: #514941;
        font-size: 15.5px;
        line-height: 1.88;
        font-weight: 600;
    }

    .dark .academic-readable {
        color: rgba(215, 206, 192, .76);
    }

    .academic-list {
        display: grid;
        gap: 12px;
        margin-top: 18px;
    }

    .academic-list-item {
        display: block;
        padding: 18px;
        border-radius: 18px;
        border: 1px solid #eee8de;
        background: #fbfaf7;
        text-decoration: none;
        transition: .2s ease;
    }

    .academic-list-item:hover {
        transform: translateY(-2px);
        background: #ffffff;
        border-color: rgba(79, 111, 82, .32);
    }

    .dark .academic-list-item {
        background: rgba(255, 255, 255, .05);
        border-color: rgba(255, 255, 255, .10);
    }

    .dark .academic-list-item:hover {
        background: rgba(255, 255, 255, .08);
    }

    .academic-list-title {
        margin: 10px 0 0;
        color: #18382c;
        font-size: 20px;
        line-height: 1.24;
        font-weight: 950;
        letter-spacing: -0.025em;
    }

    .dark .academic-list-title {
        color: #f6f1e8;
    }

    .academic-list-text {
        margin: 8px 0 0;
        color: #6b6258;
        font-size: 13.5px;
        line-height: 1.7;
        font-weight: 600;
    }

    .dark .academic-list-text {
        color: rgba(215, 206, 192, .65);
    }

    .academic-breadcrumb {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 24px;
        color: #6b6258;
        font-size: 13px;
        font-weight: 850;
    }

    .academic-breadcrumb a {
        color: #4f6f52;
        text-decoration: none;
    }

    .academic-breadcrumb a:hover {
        color: #18382c;
    }

    .dark .academic-breadcrumb {
        color: rgba(215, 206, 192, .64);
    }

    .dark .academic-breadcrumb a {
        color: #f3d998;
    }

    .reader-card {
        padding: clamp(24px, 4vw, 38px);
        border-radius: 24px;
        border: 1px solid #e7ded1;
        background: rgba(255, 255, 255, .80);
        box-shadow: 0 8px 24px rgba(31, 41, 51, .045);
    }

    .dark .reader-card {
        background: rgba(255, 255, 255, .06);
        border-color: rgba(255, 255, 255, .10);
        box-shadow: none;
    }

    .reader-body {
        color: #403a34;
        font-size: 16px;
        line-height: 1.92;
        font-weight: 600;
    }

    .dark .reader-body {
        color: rgba(246, 241, 232, .82);
    }

    .reader-section {
        margin-top: 16px;
        padding: 24px;
        border-radius: 22px;
        border: 1px solid #eee8de;
        background: #fbfaf7;
    }

    .dark .reader-section {
        background: rgba(255, 255, 255, .05);
        border-color: rgba(255, 255, 255, .10);
    }

    .reader-section-title {
        margin: 0;
        color: #18382c;
        font-size: 28px;
        line-height: 1.1;
        letter-spacing: -0.035em;
        font-weight: 950;
    }

    .dark .reader-section-title {
        color: #f6f1e8;
    }

    .reader-code {
        margin-top: 16px;
        overflow-x: auto;
        border-radius: 18px;
        background: #17212b;
        color: #f6f1e8;
        padding: 18px;
        font-size: 13px;
        line-height: 1.75;
    }

    .reader-image {
        margin-top: 16px;
        width: 100%;
        border-radius: 18px;
        border: 1px solid #e7ded1;
    }

    .dark .reader-image {
        border-color: rgba(255, 255, 255, .10);
    }

    .reader-embed {
        margin-top: 16px;
        aspect-ratio: 16 / 9;
        overflow: hidden;
        border-radius: 18px;
        background: #17212b;
    }

    .reader-embed iframe {
        width: 100%;
        height: 100%;
        border: 0;
    }

    .reader-nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid #eee8de;
    }

    .dark .reader-nav {
        border-top-color: rgba(255, 255, 255, .10);
    }

    .academic-empty {
        padding: 34px;
        margin-bottom: 78px;
        border-radius: 22px;
        border: 1px dashed #d8cbb8;
        background: rgba(255, 255, 255, .62);
        color: #6b6258;
        font-size: 14px;
        font-weight: 750;
        line-height: 1.7;
    }

    .dark .academic-empty {
        background: rgba(255, 255, 255, .05);
        border-color: rgba(255, 255, 255, .15);
        color: rgba(215, 206, 192, .68);
    }

    @media (max-width: 920px) {
        .academic-grid,
        .academic-layout {
            grid-template-columns: 1fr;
        }

        .academic-side {
            position: static;
        }

        .reader-nav {
            align-items: stretch;
            flex-direction: column;
        }

        .reader-nav .academic-btn {
            width: 100%;
        }
    }

    @media (max-width: 640px) {
        .academic-hero {
            padding: 52px 0 28px;
        }

        .academic-card,
        .academic-main,
        .academic-side {
            padding: 20px;
        }

        .academic-actions {
            align-items: stretch;
            flex-direction: column;
        }

        .academic-actions .academic-btn {
            width: 100%;
        }
    }
</style>
@endpush
@endonce