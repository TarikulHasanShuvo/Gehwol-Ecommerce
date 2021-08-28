<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gift Certificate Mail</title>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;800&display=swap');
    </style>
</head>
<body style='font-family:"Montserrat", sans-serif;margin:0;'>
<div class="container" style="display:block;width:100%;margin:0 auto;">
    Hello {{ $gift->recipient_name }},
    <br>
    <p>You have a gift certificate</p>
    <br>
    <div class="gift_page__balance_right" style="display:block;max-width:800px;margin:30px auto;border-radius:0.2604166667vw;overflow:hidden;box-sizing:border-box;padding:2.6041666667vw 2.6041666667vw 1.7708333333vw 2.6041666667vw;background:url({{$message->embed(asset('/img/gift_balance_bg.jpg'))}}) 50% 50%/cover no-repeat;">
        <div class="gift_page__balance_right_top" style="display:flex;align-items:center;justify-content:space-between;">
            <div class="left d-flex align-center" style="align-items:center;display:block; width:60%; float:left; color:#e45a54;">
                <div class="small" style="display:inline-block;font-size: 14px;">For</div>
                <div class="big" style="display:inline-block;font-weight:600;font-size: 20px;line-height: 1.3;margin-left: 8px;">{{ $gift->recipient_name }}</div>
            </div>
            <div class="right gift_code" style="display:block; width:40%; float:left; text-align: right;font-weight: 600;font-size: 17px;line-height: 1.5;color:#304150;">{{ $gift->gift_card_code }}</div>
        </div>
        <div class="gift_page__balance_right_center" style="display:block;margin-bottom:10px;">
            <div class="title" style="display:block;font-weight:bold;line-height: 1.5;font-size: 48px;text-transform:uppercase;color:#304150;">Gift certificate</div>
            <div class="description" style="display: block;font-weight: 500;font-size: 14px;line-height: 1.3;color: #304150;margin-bottom: 20px;">{{ $gift->message }}</div>
        </div>
        <div class="gift_page__balance_right_bottom" style="display:flex;align-items:flex-end;justify-content:space-between;">
            <div class="left" style="display: block; float:left;width: 50%;">
                <div class="name" style="display:block;font-weight:500;font-size: 14px;line-height: 1.3;margin-bottom: 15px;color: #304150;">From <span class="from_name">{{ $gift->client_name }}</span>
                </div>
                <div class="link" style="display: block;font-weight: 500;font-size: 14px;line-height: 1.3;color: #a5a5a5;">Redeem your gift certificate at <a href="https://www.gehwolcanada.ca" target="_blank" style="background-color:transparent;text-decoration:none; display: block">https://www.gehwolcanada.ca</a>
                </div>
            </div>
            <div class="right" style="display: block; float:left;text-align: right;width: 50%;">
                <div class="value" style="display: block; font-weight: bold; font-size: 60px;line-height: 1.5; margin-bottom: 15px;text-transform: uppercase; color: #e45a54;">${{ $gift->amount }}</div>
                <div class="logo" style="display:block;width: 90px;float: right">
                    <img src="{{$message->embed(asset('/img/logo.png'))}}" width="100%" alt="">
                </div>
            </div>
        </div>
    </div>
    <br>
    <p>
        Thanks <br>
        Gehwol
    </p>
</div>
</body>
</html>
