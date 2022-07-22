<html>

<head>
    <meta charset="utf-8">
    <title>Facture</title>
    <style>
        /* reset */

        * {
            border: 0;
            box-sizing: content-box;
            color: inherit;
            font-family: inherit;
            font-size: inherit;
            font-style: inherit;
            font-weight: inherit;
            line-height: inherit;
            list-style: none;
            margin: 0;
            padding: 0;
            text-decoration: none;
            vertical-align: top;
        }

        /* heading */

        h1 {
            font: bold 100% sans-serif;


            text-transform: uppercase;
        }

        h2 {
            font: bold 100% sans-serif;
            letter-spacing: 0.5em;
            text-align: center;
            text-transform: uppercase;
        }

        /* table */

        table {
            font-size: 75%;
            table-layout: fixed;
            width: 100%;
        }

        table {
            border-collapse: separate;
            border-spacing: 2px;
        }

        th,
        td {
            border-width: 1px;
            padding: 0.5em;
            position: relative;
            text-align: left;
        }

        th,
        td {
            border-radius: 0.25em;
            border-style: solid;
        }

        th {
            background: #EEE;
            border-color: #BBB;
        }

        td {
            border-color: #DDD;
        }

        /* page */

        html {
            font: 16px/1 'Open Sans', sans-serif;

            padding: 0.5in;

        }

        html {
            background: #999;
            cursor: default;
        }

        body {
            box-sizing: border-box;
            height: 11in;
            margin: 0 auto;

            padding: 0.5in;
            width: 7in;
        }

        body {
            background: #FFF;
            border-radius: 1px;
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
        }

        /* header */

        header {
            margin: 0 0 3em;
        }

        header:after {
            clear: both;
            content: "";
            display: table;
        }

        header h1 {
            background: #000;
            border-radius: 10px;
            color: #FFF;
            margin: 0 0 1em;
            padding: 0.5em 0;
            text-align: center;
            letter-spacing: 1rem;
        }

        header address {
            float: left;
            font-size: 75%;
            font-style: normal;
            line-height: 1.25;
            margin: 0 1em 1em 0;
        }

        header address p {
            margin: 0 0 0.25em;
        }

        header span,
        header img {
            display: block;
            float: right;
        }

        header span {
            margin: 0 0 1em 1em;
            max-height: 25%;
            max-width: 60%;
            position: relative;
        }

        header img {
            max-height: 100%;
            max-width: 100%;
        }

        header input {
            cursor: pointer;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            height: 100%;
            left: 0;
            opacity: 0;
            position: absolute;
            top: 0;
            width: 100%;
        }

        /* article */

        article,
        article address,
        table.meta,
        table.inventory {
            margin: 0 0 3em;
        }

        article:after {
            clear: both;
            content: "";
            display: table;
        }

        article h1 {
            clip: rect(0 0 0 0);
            position: absolute;
        }

        article address {
            float: left;

            font-size: 75%;
            font-style: normal;
            line-height: 1.25;
            margin: 0 1em 1em 0;

        }

        .Client {
            float: right;
            text-align: right;
            font-size: 75%;
            font-style: normal;
            line-height: 1.25;
            margin: 0 1em 1em 0;

        }

        /* table meta & balance */

        table.meta,
        table.balance {
            float: right;
            width: 36%;
        }

        table.meta:after,
        table.balance:after {
            clear: both;
            content: "";
            display: table;
        }

        /* table meta */

        table.meta th {
            width: 40%;
        }

        table.meta td {
            width: 60%;
        }

        /* table items */

        table.inventory {
            clear: both;
            width: 100%;
        }

        table.inventory th {
            font-weight: bold;
            text-align: center;
        }


        /* table balance */

        table.balance th,
        table.balance td {
            width: 50%;
        }

        table.balance td {
            text-align: right;
        }

        /* aside */

        footer {
            position: fixed;
            bottom: 0%;
            float: left;
            font-size: 75%;
            font-style: normal;
            line-height: 1.25;
            margin: 0 1em 1em 0;
        }


        /* javascript */

        .add,
        .cut {
            border-width: 1px;
            display: block;
            font-size: .8rem;
            padding: 0.25em 0.5em;
            float: left;
            text-align: center;
            width: 0.6em;
        }



        @media print {
            * {
                -webkit-print-color-adjust: exact;
            }

            html {
                background: none;
                padding: 0;
            }

            body {
                box-shadow: none;
                margin: 0;
            }

            span:empty {
                display: none;
            }

            .add,
            .cut {
                display: none;
            }
        }

        @page {
            margin: 0;
        }
    </style>
</head>

<body>
    <header>
        <h1>{{$type}}</h1>
        <address>
            <p>Jonathan Neal</p>
            <p>101 E. Chapman Ave<br>Orange, CA 92866</p>
            <p>(800) 555-1234</p>
        </address>
        <address class="Client">

            <p>{{$user->name}} {{$user->last_name}}</p>
            <p>{{$user->email}} </p>
            <p>{{$user->address}}</p>
            <p>{{$user->tel}}</p>
        </address>

    </header>

    <br>
    <article>

        <table class="meta">
            <tr>
                <th><span>{{$type}} #</span></th>
                <td><span>{{$id}}</span></td>
            </tr>
            <tr>
                <th><span>Date</span></th>
                <td><span>{{$date}}</span></td>
            </tr>

        </table>
        <table class="inventory">
            <thead>

                <tr>
                    <th><span>Item</span></th>

                    <th><span>Unit Price</span></th>
                    <th><span>Quantity</span></th>
                    <th><span>Price</span></th>
                    <th><span>Discount</span></th>
                    <th><span>Price after discount</span></th>
                    <th><span>TVA</span></th>
                </tr>

            </thead>
            <tbody>
                @php $total = 0; $i=0;
                @endphp

                @foreach($listings as $list)

                <tr>
                    <td><span>{{ $list->name }}</span></td>

                    <td><span>{{ $list->price }}</span><span data-prefix> TND</span></td>
                    <td><span>{{ $quantity[$i] }}</span></td>
                    <td><span>{{ $list->price * $quantity[$i] }}</span><span data-prefix> TND</span></td>
                    <td><span>{{$discount [$i]}}</span><span data-prefix>%</span></td>
                    <td><span>{{ $list->price * $quantity[$i] * (100-$discount[$i])/100 }}</span><span data-prefix> TND</span></td>
                    <td><span>{{ $list->tva  }}</span><span data-prefix>%</span></td>
                </tr>
                @php $i++
                @endphp
                @endforeach
                @php $i=0
                @endphp
            </tbody>
        </table>

        <table class="balance">
            <thead>

                <tr>
                    <th><span>TVA</span></th>
                    <th><span>Base</span></th>
                    <th><span>Amount</span></th>
                </tr>

            </thead>
            <tbody>
                @foreach($table as $key=>$value)

                <tr>
                    <td><span>{{ $key}}</span></td>

                    <td><span>{{ $value[0]}}</span></td>
                    <td><span>{{ $value[1] }}</span></td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </article>
    <table class="balance">
    <tr>
            <th><span>Quantity</span></th>
            <td><span>{{$Gquantity}}</span></td>
        </tr>
        <tr>
            <th><span>Total Hors Taxes</span></th>
            <td><span data-prefix>$</span><span>{{$tht}}</span></td>
        </tr>
        <tr>
            <th><span>Discount</span></th>
            <td><span data-prefix>$</span><span>{{$totalDiscount}}</span></td>
        </tr>
        <tr>
            <th><span>TVA</span></th>
            <td><span data-prefix>$</span><span>{{$tva}}</span></td>
        </tr>
        <tr>
            <th><span>Timbre Fiscal</span></th>
            <td><span data-prefix>$</span><span>{{$timbre}}</span></td>
        </tr>
        <tr>
            <th><span>Total TTC</span></th>
            <td><span data-prefix>$</span><span>{{$ttc}}</span></td>
        </tr>

    </table>

    <footer>
        <hr>

        <p>RIB : XXXXXXXXXXXXXXXXXXXX ToothFairy Bank, DreamVille</p>


    </footer>
</body>

</html>