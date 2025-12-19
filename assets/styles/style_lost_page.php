<!-- style_lost_page.php -->
<style>
    .bbody {
        position: fixed;
        top: 70px;
        left: 0;
        width: 100%;
        height: calc(100dvh - 70px);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        color: #212529;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 20px;
        text-align: center;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
        scroll-behavior: smooth;
    }
    body.light-mode .bbody {
        background: linear-gradient(135deg, #1a1a1d, #3c3c3c) !important;
        color: #f1f1f1;
    }
    .bbody .container {
        background-color: rgba(255, 255, 255, 0.9);
        padding: 40px;
        border-radius: 16px;
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        max-width: 500px;
        width: 100%;
        animation: fadeIn 0.6s ease-in-out;
        color: #333;
    }
    body.light-mode .bbody .container {
        background-color: rgba(255, 255, 255, 0.07);
        color: inherit;
    }
    .bbody .imga {
        width: 200px;
        height: auto;
        margin-bottom: 25px;
    }
    .bbody h1 {
        font-size: 30px;
        margin-bottom: 15px;
    }
    .bbody p {
        font-size: 17px;
        margin-bottom: 25px;
        line-height: 1.5;
    }
    .bbody .btns {
        background-color: #3498db;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }
    .bbody .btns:hover {
        background-color: #2980b9;
        transform: scale(1.05);
    }
    .bbody footer {
        margin-top: 25px;
        font-size: 12px;
        color: #777;
    }
    body.light-mode .bbody .container footer {
        color: #999;
    }
    @media screen and (max-width: 480px) {
        .bbody {
            top: 40px;
            height: calc(100dvh - 60px);
            padding: 15px;
        }
        .bbody .container {
            max-width: 90%;
            padding: 25px 20px;
        }
        .bbody h1 {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .bbody p {
            font-size: 13px;
            margin-bottom: 20px;
        }
        .bbody .btns {
            font-size: 14px;
            padding: 10px 20px;
        }
        .bbody .imga {
            width: 120px;
            margin-bottom: 15px;
        }
        .bbody footer {
            margin-top: 15px;
        }
    }
    @media (max-height: 600px) and (max-width: 480px) {
        .bbody .imga {
            width: 80px;
            margin-bottom: 10px;
        }
        .bbody h1 {
            font-size: 18px;
        }
        .bbody p {
            font-size: 13px;
            margin-bottom: 15px;
        }
        .bbody .container {
            padding: 15px;
        }
        .bbody footer {
            margin-top: 10px;
        }
    }
</style>