<?php
    use App\Util as u;
    $root_url = u::getRootUrl();
?>

<style>
    .doc{
        font-family:'Times New Roman';
        background-color: #dde;
        border-radius: 5px;
    }
    .title{
        color: #078ddb;
        padding: 10px 15px;
        font-style: italic;
    }

    .img-title{
        padding: 5px 10px;
        color:#2f7ba7;
        font-family:'Times New Roman';
        background-image: linear-gradient(
                to bottom,
                #bcc,
                #ffe
        );
        border-radius:5px;
        text-align:center;
    }

    .img-info{
        padding: 5px 10px;
        color:#6d2fa7;
        font-family:'Times New Roman';
        background-image: linear-gradient(
                to bottom,
                #bcc,
                #ffe
        );
        border-radius:5px;
        font-size: 1.2em;
        font-style:italic;
    }

    .intro{
        font-style: italic;
        padding: 5px 10px;
        color:#345;
    }

    .desc{
        color:#91923b;
        padding: 5px 10px;
    }

    .features{
        color: #444;
        padding: 5px 10px;
        font-style: italic;
    }

    .img{
        border-radius:5px;
        border:solid;
        border-color:#444;
        margin-left:auto;
        margin-right: auto;
        width: 100%;
        display:block;
    }

    @media screen and (max-width: 600px) {
        .img{
            width:100%;
        }
    }

</style>
<div class="doc">

    <h3 class='title'>Alvand software products in a glance</h3>

    <h5 class="intro">Real Estate Company System (R.E.C.S)</h5>
    <h6 class="desc">A desktop application for real estate activities with the following main features</h6>
    <span class='features'>Mortgage | Rent | Purchase | Sell</span>
    <div class="image-container">
    <img class='img' src="./img/real-estate-01.jpg" alt="real estate image">
    <div class="top-left">
        <h3 class="img-title anm_taxi_left_slow" style="padding-left:5px; width:50%;'"><em>Alvand</em> Company</h3>
        <div style="text-align:left;" class="anm_taxi_top">
            <span class="img-info">Real Estate Company System (R.E.C.S)</span> <br>
        </div>
    </div>
    </div>
    <hr>
    <!-- -------------------------------------------------- -->


    <h5 class="intro">Document Archive System (D.A.S)</h5>
    <h6 class="desc">A desktop application for archiving documents providing:</h6>
    <span class='features'>Instant Content Search | Versioning | Document History | Document Distribution | Group Collaboration</span>
    <div class="image-container">
    <img class='img' src="./img/archive-01.png" alt="archive image">
    <div class="top-left">
        <h3 class="img-title anm_taxi_left_slow" style="padding-left:5px; width:50%;" ><em>Alvand</em> Company</h3>
        <div style="text-align:left; font-style:italic;" class="anm_taxi_top">
            <span class="img-info">Document Archive System (D.A.S)</span> <br>
        </div>
    </div>
    </div>
    <hr>
    <!-- -------------------------------------------------- -->

    <h5 class="intro">Bazaar</h5>
    <h6 class="desc">Useful accountant app for small and medium stores with tens of cool features</h6>
    <span class='features'>Accounting | Warehousing | Barcode Support | Automatic Update | SMS To Customers | Cost-Benefit Analysis | Report Center</span>
    <div class="image-container">
    <img class='img' src="./img/bazaar-01.jpg" alt="bazaar image">
    <div class="top-left">
        <h3 class="img-title anm_taxi_left_slow" style="padding-left:5px; width:50%;" ><em>Alvand</em> Company</h3>
        <div style="text-align:left; font-style:italic;" class="anm_taxi_top">
            <span class="img-info">Bazaar</span> <br>
        </div>
    </div>
    </div>
    <hr>
    <!-- -------------------------------------------------- -->

    <h5 class="intro">Budget Management System (B.M.S)</h5>
    <h6 class="desc">A desktop application for managing income and expense:</h6>
    <span class='features'>Shopping Category | Income Source | Installment | Expense Diagrams | Reports</span>
    <div class="image-container">
    <img class='img' src="./img/budget-01.jpg" alt="budget image">
    <div class="top-left">
        <h3 class="img-title anm_taxi_left_slow" style="padding-left:5px; width:50%;" ><em>Alvand</em> Company</h3>
        <div style="text-align:left; font-style:italic;" class="anm_taxi_top">
            <span class="img-info">Budget Management System (B.M.S)</span> <br>
        </div>
    </div>
    </div>
    <hr>
    <!-- -------------------------------------------------- -->

    <h5 class="intro">Paycheck System</h5>
    <h6 class="desc">Wage calculation and pay-check generation. Quite useful for middle size corporations.</h6>
    <span class='features'>Defining Staff | Defining Wage Items | Taxation | Insurance | Reports</span>
    <div class="image-container">
    <img class='img' src="./img/paycheck-01.jpg" alt="paycheck image">
    <div class="top-left">
        <h3 class="img-title anm_taxi_left_slow" style="padding-left:5px; width:50%;" ><em>Alvand</em> Company</h3>
        <div style="text-align:left; font-style:italic;" class="anm_taxi_top">
            <span class="img-info">Paycheck System</span> <br>
        </div>
    </div>
    </div>
    <hr>
    <!-- -------------------------------------------------- -->

    <h5 class="intro">Secretariat System</h5>
    <h6 class="desc">A useful app for keep tracking of incoming and outgoing letters of a middle size institute with the following main features:</h6>
    <span class='features'>Institute Organization Chart | Letter Registration | Letter Archive </span>
    <div class="image-container">
    <img class='img' src="./img/secretariat-01.jpg" alt="secretariat image">
    <div class="top-left">
        <h3 class="img-title anm_taxi_left_slow" style="padding-left:5px; width:50%;" ><em>Alvand</em> Company</h3>
        <div style="text-align:left; font-style:italic;" class="anm_taxi_top">
            <span class="img-info">Secretariat System</span> <br>
        </div>
    </div>
    </div>
    <hr>
    <!-- -------------------------------------------------- -->


</div>