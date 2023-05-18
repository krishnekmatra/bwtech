<!DOCTYPE html>
<html>
<head>
    <title>Ekmatra Wishlist</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <p><center><img src="{{public_path().'/logo.png'}}" style="max-width:25%"></center></p><br/>
    <table class="table table-bordered">
        <tr>
            <th>S.No</th>
           <th>Category</th>

            <th>Name</th>
            <th>Mrp</th>
            <th>Image</th>


        </tr>
        @foreach($wishlists['ProductWishList'] as $wishlist)
        <tr>
            <td>{{ $loop->iteration}}</td>
                        <td>{{$wishlist['getProduct']['category']['name']}}</td>

            <td>{{ $wishlist['getProduct']['name'] }}</td>
           
            <td>{{ $wishlist->getProduct->mrp }}</td>
             <td> <img src="{{public_path().'/product/'.$wishlist->getProduct->image }}" width="100" height="100"></td>
        </tr>
        @endforeach
    </table>
  
</body>
</html>
