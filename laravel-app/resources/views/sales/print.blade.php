<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hóa đơn bán hàng</title>
</head>

<style>
    body {
        font-family: "Dejavu Sans" !important
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }


    th {
        /* border: 1px solid #dddddd; */
        font-size: 13px;
        text-align: left;
        padding: 8px;
        text-align: center;
        background-color: rgb(198, 194, 219);
        border: 1px solid rgb(78, 76, 76);
    }

    td {

        font-size: 13px;
        border: 1px solid rgb(78, 76, 76);
        color: rgb(57, 57, 57),

    }

    p {
        font-size: 13px;
        margin: 3px;
    }

    .bold {
        font-size: 18px;
        font-weight: bold;
    }

    .title {
        text-align: center;
    }

    .sale {
        color: red
    }

    .date {
        font-size: 12px;
        margin: 10px 50px 10px 450px;
    }

    .collecter {
        font-size: 12px;
        font-weight: bold;
        margin: 10px 50px 10px 475px;
    }

    .name {
        margin-top: 30px;
        font-size: 16px;
        text-transform: uppercase;
        margin: 10px 100px 10px 470px;
    }
</style>

<body>
    <div class="title">
        <p class="bold">CỬA HÀNG TẠP HÓA STORE 04</p>
        <p>Địa chỉ: Khu II, Đ. 3/2, Xuân Khánh, Ninh Kiều, Cần Thơ</p>
    </div>
    <hr>
    <h3 class="title bold sale">PHIẾU THU</h3>
    <div class="customer">
        <p style="text-transform: uppercase">
            <span style="font-weight:bold; text-transform:none">Tên khách hàng: </span>{{ $printSale->sl_name }}
        </p>
        <p><span style="font-weight:bold">Địa chỉ: </span>{{ $printSale->sl_addr }}</p>
    </div>
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên hàng</th>
                    <th>ĐVT</th>
                    <th>SL</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 1; //Initialize variable
                @endphp
                @foreach ($printData as $sdt)
                    <tr>
                        <td style="text-align: center">{{ $count++ }}</td>
                        <td>{{ $sdt->name }}</td>
                        <td style="text-align: center">{{ $sdt->unit }}</td>
                        <td style="text-align: center">{{ $sdt->quantity }}</td>
                        <td style="text-align:right">{{ number_format($sdt->saleprice) }}</td>
                        <td style="text-align:right">{{ number_format($sdt->totalprice) }}</td>
                    </tr>
                @endforeach
                {{-- @endfor --}}
                <tr>
                    <td colspan="5" style="text-align: center; font">Cộng tiền hàng:</td>
                    <td style="text-align:right">{{ number_format($printSum->total) }}</td>
                </tr>

            </tbody>
        </table>
        <p class="date">Ngày lập: {{ $printSale->sl_date }}</p>
        <p class="collecter">Người thu tiền</p>
        <p class="name">{{ session('LoginName') }}</p>
    </div>
</body>



</html>
