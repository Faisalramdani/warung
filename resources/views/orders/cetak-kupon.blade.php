<!DOCTYPE html>
<html>
<head>
<title>Laporan Penjualan</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style type="text/css">

*{
    padding: 0px;
    margin: 0px;
}

.box{
  /* Rectangle 1 */


box-sizing: border-box;

position: absolute;
width: 712px;
height: 460px;
/* left: 65px; */
top: 67.5px;

border: 5px solid #025482;
}

.text{

    /* Setiap Pembelian Air Minuman Mineral DARMA 1 galon dapat 1 Kupon */

    position: absolute;
    width: 452px;
    height: 58px;
    left: 140px;
    top: 65.28px;

    font-family: 'Inter';
    font-style: normal;
    font-weight: 400;
    font-size: 24px;
    line-height: 29px;
    text-align: center;

    color: #025482;
}

.text-title{
    /* Terima Kasih */


position: absolute;
width: 304px;
height: 52px;
left: 210px;
top: 146.98px;

font-family: 'Lemon';
font-style: normal;
font-weight: 400;
font-size: 40px;
line-height: 52px;
text-align: center;

color: #025482;

}

.box-2{
    /* Rectangle 2 */


box-sizing: border-box;

position: absolute;
width: 647.05px;
height: 65px;
left: 25px;
top: 222.37px;

background: #D9D9D9;
border: 4px solid #025482;
border-radius: 20px;
}

.text-box{
    position: relative;;
    /* z-index: 1; */
width: 607px;
/* height: 52px; */
left: 20px;
/* top: 168.87px; */

font-family: 'Lemon';
font-style: normal;
font-weight: bold;
font-size: 40px;
line-height: 52px;
text-align: center;

color: #025482;
}

.text-footer{
    /* Kumpulkan 10 Lembar Kupon dapat di tukarkan dengan AIR Minum Mineral DARMA 1 Galon Gratis!!! Tidak dapat di uangkan!!! */


position: absolute;
width: 605px;
height: 144px;
left: 60px;
top: 321.07px;

font-family: 'Inter';
font-style: normal;
font-weight: 400;
font-size: 24px;
line-height: 29px;
text-align: center;

color: #025482;

}

</style>
</head>
<body>
    <div class="container">
        {{-- <img src="{{ asset('images/bg-coupon.png') }}" alt="" srcset=""> --}}
        {{-- <h1>Kupon</h1> --}}
        <div class="box">
            <h2 class="text">
                Setiap Pembelian Air Minuman Mineral
DARMA 1 galon dapat 1 Kupon
            </h2>
            <h1 class="text-title">
                Terima Kasih
            </h1>
            <div class="box-2">
                <h1 class="text-box">
                    {{ $orders->customer->first_name }}
                </h1>
            </div>
            <h2 class="text-footer">
                Kumpulkan 10 Lembar Kupon dapat di tukarkan dengan AIR Minum Mineral DARMA 
                <br><b>1 Galon Gratis!!!</b></br> 
                <br>Tidak dapat di uangkan!!!</br>
            </h2>
        </div>
    </div>
</body>
</html>
