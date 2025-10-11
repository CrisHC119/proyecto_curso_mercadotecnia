<style>
    #mainContent {
        max-width: 1400px;
        margin: 40px auto;
        background-color: #ffffff;
        color: #1a1a1a;
        border-radius: 12px;
        padding: 1rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
    }

    .accordion {
        background-color: transparent;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        max-width: 1500px;
        margin: 0 auto;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        overflow: hidden;
    }

    .accordion-button,
    .sub-accordion-button {
        background-color: #ffffff;
        color: #111827;
        cursor: pointer;
        padding: 1rem 1.25rem;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 1rem;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: background-color 0.2s ease-in-out;
    }

    .accordion-button {
        border-bottom: 1px solid #e5e7eb;
    }

    .accordion > div:last-of-type > .accordion-button {
        border-bottom: none;
    }

    .accordion-button:hover,
    .sub-accordion-button:hover {
        background-color: #f9fafb;
    }

    .accordion-button:focus-visible,
    .sub-accordion-button:focus-visible {
        box-shadow: inset 0 0 0 2px #d1d5db;
    }

    .accordion-button::after,
    .sub-accordion-button::after {
        content: '\002B';
        font-size: 1.4rem;
        font-weight: 300;
        color: #6b7280;
        transition: transform 0.3s ease-in-out;
    }

    .accordion-button.active::after,
    .sub-accordion-button.active::after {
        transform: rotate(45deg);
    }

    .accordion-content,
    .sub-accordion-content {
        background-color: #f9fafb;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out, padding 0.3s ease-out;
        padding-left: 1.25rem;
        padding-right: 1.25rem;
    }

    .accordion-content.show,
    .sub-accordion-content.show {
        max-height: 2000px;
        padding-top: 1rem;
        padding-bottom: 1rem;
    }

    .sub-accordion-button {
        padding-left: 2.5rem;
        font-size: 0.95rem;
        background-color: #f9fafb;
        border-top: 1px solid #e5e7eb;
        border-bottom: 1px solid #e5e7eb;
    }

    .sub-accordion-content {
        background-color: #f9fafb;
        padding-left: 3.5rem;
        border-left: none;
    }

    .subtema-text {
        font-size: 0.9rem;
        color: #4b5563;
        margin-bottom: 0.75rem;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        #mainContent {
            padding: 0.5rem;
            margin: 15px 8px;
            border-radius: 8px;
        }
        .accordion-button,
        .sub-accordion-button {
            font-size: 0.9rem;
            padding: 0.75rem 1rem;
        }
        .sub-accordion-button {
            padding-left: 2rem;
        }
        .sub-accordion-content {
            padding-left: 2.5rem;
        }
        .subtema-text {
            font-size: 0.85rem;
        }
    }

    body.light-mode #mainContent {
        background-color: #111827;
        color: #f9fafb;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
    }

    body.light-mode .accordion {
        border-color: #374151;
    }

    body.light-mode .accordion-button,
    body.light-mode .sub-accordion-button {
        background-color: #1f2937;
        color: #f3f4f6;
    }

    body.light-mode .accordion-button {
        border-bottom-color: #374151;
    }

    body.light-mode .accordion-button:hover,
    body.light-mode .sub-accordion-button:hover {
        background-color: #374151;
    }

    body.light-mode .accordion-button:focus-visible,
    body.light-mode .sub-accordion-button:focus-visible {
        box-shadow: inset 0 0 0 2px #4b5563;
    }

    body.light-mode .accordion-button::after,
    body.light-mode .sub-accordion-button::after {
        color: #9ca3af;
    }

    body.light-mode .accordion-content,
    body.light-mode .sub-accordion-content {
        background-color: #111827;
    }

    body.light-mode .sub-accordion-button {
        background-color: #1f2937;
        border-top: 1px solid #374151;
        border-bottom: 1px solid #374151;
    }

    body.light-mode .subtema-text {
        color: #d1d5db;
    }
    .accordion-button,
    .accordion-button:hover,
    .accordion-button:focus,
    .accordion-button:active,
    .sub-accordion-button,
    .sub-accordion-button:hover,
    .sub-accordion-button:focus,
    .sub-accordion-button:active {
        background-color: #fff !important;
        color: #000 !important;
        box-shadow: none !important; 
        outline: none !important;    
    }
    body.light-mode .accordion-button,
    body.light-mode .accordion-button:hover,
    body.light-mode .accordion-button:focus,
    body.light-mode .accordion-button:active {
        background-color: #333 !important;
        color: #eee !important;
    }
    body.light-mode .sub-accordion-button,
    body.light-mode .sub-accordion-button:hover,
    body.light-mode .sub-accordion-button:focus,
    body.light-mode .sub-accordion-button:active {
        background-color: #2a2a2a !important;
        color: #ccc !important;
    }
</style>