<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Completion Certificate</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Open+Sans:wght@300;400;600&family=Dancing+Script:wght@400;700&display=swap');
        
        body {
            margin: 0;
            padding: 0;
            font-family: 'Open Sans', sans-serif;
            background: white;
            page-break-inside: avoid;
        }
        
        .certificate {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            position: relative;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            overflow: visible;
            page-break-inside: avoid;
            min-height: 90vh;
        }
        
        .ornate-border {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 12px solid #1a365d;
            border-radius: 15px;
            background: #f8f9fa;
            box-sizing: border-box;
        }
        
        .inner-border {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;
            border: 3px solid #2d5a87;
            border-radius: 8px;
            background: white;
            box-sizing: border-box;
        }
        
        .certificate-content {
            position: relative;
            z-index: 10;
            padding: 30px 50px 50px 50px;
            text-align: center;
            page-break-inside: avoid;
        }
        
        .certificate-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a365d;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .institution-info {
            border: 2px solid #2d5a87;
            border-radius: 8px;
            padding: 10px 20px;
            margin: 5px auto;
            display: inline-block;
            background: rgba(26, 54, 93, 0.05);
        }
        
        .institution-name {
            font-family: 'Open Sans', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            color: #1a365d;
            margin: 0;
        }
        
        .certificate-text {
            font-family: 'Open Sans', sans-serif;
            font-size: 1.1rem;
            color: #2d3748;
            margin: 10px 0;
            line-height: 1.5;
        }
        
        .recipient-section {
            margin: 10px 0;
            position: relative;
        }
        
        .recipient-name {
            font-family: 'Dancing Script', cursive;
            font-size: 2.8rem;
            font-weight: 700;
            color: #1a365d;
            margin: 10px 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        
        .recipient-name::before,
        .recipient-name::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 100px;
            height: 2px;
            background: #2d5a87;
        }
        
        .recipient-name::before {
            left: -120px;
        }
        
        .recipient-name::after {
            right: -120px;
        }
        
        .achievement-description {
            font-family: 'Open Sans', sans-serif;
            font-size: 1rem;
            color: #2d3748;
            margin: 10px 0;
            line-height: 1.5;
            max-width: 650px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .certificate-footer {
            margin-top: 20px;
            width: 100%;
            page-break-inside: avoid;
            page-break-before: avoid;
            height: 100px;
            position: relative;
        }
        
        .footer-left {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 33.33%;
            text-align: center;
        }
        
        .footer-center {
            position: absolute;
            left: 33.33%;
            top: 50%;
            transform: translateY(-50%);
            width: 33.33%;
            text-align: center;
        }
        
        .footer-right {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 33.33%;
            text-align: center;
        }
        
        .signature-line {
            width: 120px;
            height: 2px;
            background: #2d5a87;
            margin: 5px auto 3px;
            position: relative;
        }
        
        .signature-line::after {
            content: '';
            position: absolute;
            right: -12px;
            top: -4px;
            width: 0;
            height: 0;
            border-left: 10px solid #2d5a87;
            border-top: 5px solid transparent;
            border-bottom: 5px solid transparent;
        }
        
        .signature-name {
            font-family: 'Open Sans', sans-serif;
            font-size: 0.7rem;
            font-weight: 600;
            color: #1a365d;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            line-height: 1.1;
        }
        
        .signature-title {
            font-family: 'Open Sans', sans-serif;
            font-size: 0.6rem;
            color: #4a5568;
            margin: 1px 0 0;
            line-height: 1.1;
        }
        
        .award-seal {
            width: 70px;
            height: 70px;
            border: 3px solid #d4af37;
            border-radius: 50%;
            background: #ffd700;
            margin: 0 auto;
            position: relative;
            z-index: 10;
            text-align: center;
            display: table-cell;
            vertical-align: middle;
            padding: 0;
            box-sizing: border-box;
        }
        
        .award-text {
            font-family: 'Playfair Display', serif;
            font-size: 0.6rem;
            font-weight: 700;
            color: #1a365d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0;
            z-index: 15;
            position: relative;
            line-height: 1;
            text-align: center;
            display: block;
        }
        
        .award-year {
            font-family: 'Open Sans', sans-serif;
            font-size: 0.8rem;
            font-weight: 600;
            color: #1a365d;
            margin: 0;
            z-index: 15;
            position: relative;
            line-height: 1;
            text-align: center;
            display: block;
        }
        
        .date-section, .id-section {
            text-align: center;
            font-family: 'Open Sans', sans-serif;
            font-size: 0.6rem;
            color: #4a5568;
            margin-top: 0px;
            line-height: 1.0;
        }
        
        .date-value, .id-value {
            font-weight: 600;
            color: #1a365d;
            font-size: 0.7rem;
            display: block;
            margin-bottom: 1px;
        }
        
        .logo-container {
            text-align: center;
            margin: 0 0 2px 0;
        }
        
        .company-logo {
            max-width: 120px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="ornate-border"></div>
        <div class="inner-border"></div>
        
        <div class="certificate-content">
            <h1 class="certificate-title">Completion Certificate</h1>
            
            <div class="institution-info">
                <p class="institution-name">The Coding Skills | Grow Step by Step</p>
            </div>
            
            <p class="certificate-text">Certificate is presented to:</p>
            
            <div class="recipient-section">
                <div class="recipient-name">{{$data['name']}}</div>
            </div>
            
            <p class="achievement-description">
                For successful completion of the comprehensive assessment in <strong>{{$data['quiz']}}</strong>. 
                In recognition of outstanding achievements in the field of programming, demonstrating 
                proficiency, dedication, and commitment to excellence in software development.
            </p>
            
            <div class="certificate-footer">
                <div class="footer-left">
                    <div class="logo-container">
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/the_coding_skills.png'))) }}" alt="The Coding Skills Logo" class="company-logo">
                    </div>
                    <div class="date-section">
                        <p class="date-value">{{date('m/d/Y')}}</p>
                        <p>Awarded on</p>
                    </div>
                </div>
                
                <div class="footer-center">
                    <div class="award-seal">
                        <p class="award-text">Award</p>
                        <p class="award-year">{{date('Y')}}</p>
                    </div>
                </div>
                
                <div class="footer-right">
                    <div class="signature-line"></div>
                    <p class="signature-name">Verification Seal</p>
                    <p class="signature-title">The Coding Skills</p>
                    <div class="id-section">
                        <p class="id-value">{{str_pad(rand(10000000000, 99999999999), 11, '0', STR_PAD_LEFT)}}</p>
                        <p>Certificate ID</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>