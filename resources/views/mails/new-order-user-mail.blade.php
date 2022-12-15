<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NewOrderUserMail</title>
</head>
<body>
    <br>
    <br>
    <img src="https://i.ibb.co/8BJ7h21/logodone-ROSSO.png" alt="logo">

    <div>Ciao <strong>{{$user->business_name}}</strong> hai ricevuto un nuovo ordine!</div>
    
    <br>

    <p>Ordine N.{{ $new_order->order_number}} </p>

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
     
    <div>Per un totale di: {{$new_order->total_amount}}€</div>

    <br>

    <div>I dettagli per la consegna sono disponibili nella tua
        <a href="{{route ('admin.orders')}}">sezione ordini.</a>
    </div>
    <br>
    <br>

</body>

<style>
body{
    padding-left: 70px;
    font-size: 21px;
    border: 2px solid #740602
    
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

    