<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk</title>
    <style>
        .body {
            font-family: monospace;
            /* width: 300px; */
            width: 80mm;
            margin: auto;
            padding: 10px;
        }

        .struk {
            text-align: center;
        }

        .line {
            margin: 5px 0;
            border-top: 1px dashed black;
        }

        .info,
        .product,
        .summary {
            text-align: left;
        }

        .product .item {
            margin-bottom: 5px;
        }

        .product .item-qty {
            display: flex;
            justify-content: space-between;
        }

        .info .row,
        .summary .row {
            display: flex;
            justify-content: space-between;
            margin: 2px 0;
        }

        footer {
            text-align: center;
            font-size: 13px;
            margin-top: 10px;
        }

        @media print {
            body {
                width: 80mm;
                margin: 0;
            }
        }
    </style>
</head>

<body>
    <div class="struk">
        <div class="struk-header">
            <h3>Kedai Kopi PPKD JP</h3>
            <h2>Enak Lho</h2>
            <div class="info">
                Jl. Karet Baru Benhill Jakarta Pusat
                <br>
                08994839202
            </div>
        </div>
        <div class="line"></div>
        <div class="info">
            <div class="row">
                <span>20 Juni 2025</span>
                <span>9:39</span>
            </div>
            <div class="row">
                <span>Cashier</span>
                <span>Reza</span>
            </div>
            <div class="row">
                <span>Order Id</span>
                <span>TR-200625-001</span>
            </div>
        </div>
        <div class="line"></div>
        <div class="product">
            <div class="item">
                <strong>Es Smooth Vanilla Cofee</strong>
                <div class="item-qty">
                    <span>1x @ 20.000</span>
                    <span>Rp. 20.000</span>
                </div>
            </div>
            <div class="line"></div>
            <div class="summary">
                <div class="row">
                    <span>Subtotal</span>
                    <span>Rp. 20.000</span>
                </div>
            </div>
            <div class="line"></div>
            <footer class="text-center">
                Terimakasih sudah membeli disini
            </footer>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>