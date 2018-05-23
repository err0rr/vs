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
            <td colspan="2"><img src="{!! URL::to('img/email/images/ban1.png') !!}" style="width: 100%"></td>
        </tr>
        <tr>  
            <td colspan="2"><h4 style="text-align: center;margin:20px;font-size: 45px;">Thank You For Your Booking</h4></td>
        </tr>
        <tr>  
            <td colspan="2"><p style="margin:10px 0px;padding: 0px 10px">Hi Dear Member</p></td>
        </tr>
        <tr>  
            <td style="padding: 0px 10px">Name</td><td style="padding: 0px 10px">: {{ ucfirst($nameescort) }}</td>
        </tr>
        <tr>  
            <td style="padding: 0px 10px">Book Date</td><td style="padding: 0px 10px">: {{ date('d-m-Y', strtotime($date)) }}</td>
        </tr>
        <tr>  
            <td style="padding: 0px 10px">Book Time</td><td style="padding: 0px 10px">: {{ date('h.i A', strtotime($starttime)) }} - {{ date('h.i A', strtotime($endtime)) }}09.00 Am - 07.00 Pm</td>
        </tr>
        <tr>  
            <td style="padding: 0px 10px">Price</td><td style="padding: 0px 10px">: {{ $rate }}</td>
        </tr>
        <tr>  
            <td style="padding: 0px 10px">Title</td><td style="padding: 0px 10px">: {{ ucfirst($title) }}</td>
        </tr>
        <tr>  
            <td style="padding: 0px 10px">Status</td><td style="padding: 0px 10px">: {{ ucfirst($status) }}</td>
        </tr>
        <tr style="text-align: center;">  
           <td colspan="2" style="padding: 30px 5px 20px;"><a href="#" style="text-align: center;color: #fff;background: #ffb200;padding: 10px 20px;border-radius: 5px;text-decoration: none;">Chat Now</a></td>
        </tr>
        </tbody>
    </table>
    <table style="width: 800px;border: none;color: #333;margin:30px auto;font-size: 25px;text-align: center;">
      <tbody>
          <tr>
            <td colspan="2">Copyright @ Company</td>
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




