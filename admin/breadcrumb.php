<?php
if($_GET['halamane']=='home'){
}


// Bagian Kategori
elseif ($_GET['halamane']=='kategori'){
    echo "<li class='active'>Kategori</li>";
}

// Bagian Produk
elseif ($_GET['halamane']=='produk'){
    echo "<li class='active'>Produk</li>";
}


// Bagian Order
elseif ($_GET['halamane']=='order'){
    echo "<li class='active'>Order</li>";
}



// Bagian Kota/Ongkos Kirim
elseif ($_GET['halamane']=='tujuan'){
     echo "<li class='active'>Tujuan</li>";
}

// Bagian Password
elseif ($_GET['halamane']=='password'){
    echo "<li class='active'>Password</li>";
}


?>
