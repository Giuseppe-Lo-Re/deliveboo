<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <br>
    <br>
    <img src="https://i.ibb.co/mS0b0sL/logo-GIALLOdone.png" alt="logo">
    
    <div>Ciao <strong>{{$new_order->customer_name}}</strong>,
        <br>
        grazie da
        <a href="http://127.0.0.1:8000/">Toast Rider</a>, stiamo elaborando il tuo ordine!
    </div>

    <br>

    <p style="width: 500px;"> Numero ordine: {{$new_order->order_number}}
      
    <table style="width:500px; text-align: center">
        <tr>
          <th>Prodotto</th>
          <th>Quantità</th>
          <th>Prezzo</th>
        </tr>

        @foreach ($new_order->products as $product)
        <tr>
          <td>{{$product->name}}</td>
                  
          <td>{{$product->pivot['quantity']}}</td>
                    
          <td>{{$product->price}}€</td>
        </tr>
        @endforeach

    </table>

    <br>

    <p>Per un totale di: {{$new_order->total_amount}}€</p>
    <br>
   
   
    <dl>
        <dt>Informazioni di consegna:</dt>
        <dd><i>{{$new_order->customer_name}}</i></dd>
        <dd><i>{{$new_order->customer_address}}</i></dd>
        <dd><i>{{$new_order->customer_mail}}</i></dd>
        <dd><i>{{$new_order->customer_phone_number}}</i></dd>
    </dl>
    <br>
    <br>
            
    
</body>

<style>
body{
    padding-left: 70px;
    font-size: 21px;
    border: 2px solid #ffc509
  
}
div{
    padding-top: 50px;
}
a{
    padding: 0;
}
tr{
    text-align: center;
}

th{
    text-align: center;
    border-bottom: 1px solid green;
}
img{
    padding-left: 200px;
    width: 155px;
}
a{
    text-decoration: none;
}

</style>
</html>