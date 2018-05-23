<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css">
  @font-face {
  font-family: 'CenturyGothic';
  src: url('../img/email/fonts/CenturyGothic.eot?#iefix') format('embedded-opentype'),  url('../img/email/fonts/CenturyGothic.woff') format('woff'), url('../img/email/fonts/CenturyGothic.ttf')  format('truetype'), url('../img/email/fonts/CenturyGothic.svg#CenturyGothic') format('svg');
  font-weight: normal;
  font-style: normal;
}

</style>
</head>

<body style="background: #f9f9f9;font-family: 'CenturyGothic';">


    <table style="width: 800px;border: none;color: #333;margin:30px auto;font-size: 25px;border-spacing: 0px;">
    <thead>
      <tr>
            <td colspan="2"><img src="{!! URL::to('img/email/images/logo.png') !!}"></td>
        </tr>
    </thead>
        <tbody style="background: #fff;">
        
        <tr>  
            <td colspan="2"><img src="{!! URL::to('img/email/images/ban4.png') !!}" style="width: 100%"></td>
        </tr>
        <tr>  
            <td colspan="2"><h4 style="text-align: center;margin:20px;font-size: 45px;">Confirm Your Account!</h4></td>
        </tr>
        <tr>  
            <td colspan="2"><p style="margin:10px 0px 15px;padding: 0px 10px">Hi {{ ucfirst($name) }},</p></td>
        </tr>
        <tr>  
            <td colspan="2" style="padding: 0px 10px">Thank you for joining the client at <a href="http://myangels.ch" style="color: #71bbe6;text-decoration: none;">myangels.ch.</a></td>
        </tr>
        <tr>  
            <td colspan="2" style="padding: 0px 10px">To enjoy our service please confirm your account.</td>
        </tr>
      
        <tr style="text-align: center;">  
            <td colspan="2" style="padding: 30px 5px 20px;"><a href="{!! url('account/confirm/' . $token) !!}" style="text-align: center;color: #fff;background: #ffb200;padding: 10px 20px;border-radius: 5px;text-decoration: none;">Confirm Your Account!</a></td>
        </tr>
        </tbody>
    </table>
    <table style="width: 800px;border: none;color: #333;margin:30px auto;font-size: 25px;text-align: center;">
      <tbody>
      <tr>
            <td colspan="2">Having trouble with the links in this email?</td>
          </tr>
          <tr>
            <td colspan="2">Copy and paste this link into your browser to confirm:</td>
          </tr>
          <tr>
            <td colspan="2"><a href="#" style="color: #71bbe6;text-decoration: none;">{!! url('account/confirm/' . $token) !!}</a></td>
          </tr>
          <tr>
            <td colspan="2" style="padding-top: 20px;">Copyright @ Company</td>
          </tr>
          <tr>
            <td colspan="2">Tel - 42-67-85 The Theme Control</td>
          </tr>
           <tr>
            <td colspan="2">Address . FAQ's . Contact Us</td>
          </tr>
          <tr>
            <td colspan="2" style="padding-top: 15px;"><img src="{!! URL::to('img/email/images/logo.png') !!}"></td>
          </tr>
      </tbody>

    </table>
</body>
</html>
