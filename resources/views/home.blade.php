<?php 
    $page_title='home';
    $sec='HOME';
?>

@extends('active-contents')
@section('pre_active_content')
    
@stop

@section('post_active_content')
<?php
    echo "<div class='center'>";
    echo view('cmp-thumbnail',[
        'id'=>'t1',
        'title'=>'Budget App',
        'img_src'=>'/img/budget-01.jpg',
        'img_alt'=>'budget',
        'arr_splash'=>['Shopping Category' , 'Income Source' , 'Installment' , 'Expense Diagrams' , 'Reports'],
    ]);

    echo view('cmp-thumbnail',[
        'id'=>'t2',
        'title'=>'Paycheck App',
        'img_src'=>'/img/paycheck-01.jpg',
        'img_alt'=>'paycheck',
        'arr_splash'=>['Defining Staff' , 'Defining Wage Items' , 'Taxation' , 'Insurance' , 'Reports'],
    ]);

    echo view('cmp-thumbnail',[
        'id'=>'t3',
        'title'=>'Secretariat App',
        'img_src'=>'/img/secretariat-01.jpg',
        'img_alt'=>'secretariat',
        'arr_splash'=>['Institute Organization Chart' , 'Letter Registration' , 'Letter Archive'],
    ]);

    echo view('cmp-thumbnail',[
        'id'=>'t4',
        'title'=>'Real Estate App',
        'img_src'=>'/img/real-estate-01.jpg',
        'img_alt'=>'Real Estate',
        'arr_splash'=>['Mortgage' , 'Rent' , 'Purchase' , 'Sell'],
    ]);

    echo view('cmp-thumbnail',[
        'id'=>'t5',
        'title'=>'Bazaar App',
        'img_src'=>'/img/bazaar-01.jpg',
        'img_alt'=>'bazaar',
        'arr_splash'=>['Accounting' , 'Warehousing' , 'Barcode Support' , 'Automatic Update' , 'SMS To Customers' , 'Cost-Benefit Analysis' , 'Report Center'],
    ]);

    echo "</div>";
?>    
@stop
