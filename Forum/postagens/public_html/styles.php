<script src="..\script\jquery-3.1.1.min.js"></script>
<link rel="stylesheet" href="..\styles\bootstrap-3.3.7-dist\css\bootstrap.min.css">
<script src="..\styles\bootstrap-3.3.7-dist\js\bootstrap.min.js"></script>

<?php header("Content-Type: text/html; charset=utf-8"); ?>

<style type="text/css">
  #centro{
    margin: 0 auto;
    width: 600px;
    /*font-size: 18px;*/
  }

  #centro2{
    margin: 0 auto;
    width: 600px;
    font-size: 18px;
  }

  #centroMenor{
    margin: 0 auto;
    width: 450px;
    /*font-size: 18px;*/
  }

  #centroMaior{
    margin: 0 auto;
    width: 1150px;
    /*font-size: 18px;*/
  }

  #normal{
    /*margin: 0 auto;
    width: 1150px;*/
    font-size: 18px;
  }
  #normal2{
    margin: 0 auto;
    width: 900px;
    /*font-size: 15px;*/
  }

  #div_content{
    /*alignment-adjust:central;*/
    /*alignment-baseline:central;*/
    width:auto;
    height:auto;
    margin:auto;
    /*text-align:justify;*/
    border-style:solid solid solid double;
    border-width: 1px 1px 1px 1px;
    /*padding:3px;*/
    /*border-color:#060 #666 #666 #060;*/
    /*position:relative;*/
  }

  #h1h4{
    font-size: 20px;
  }
  #h2{
    font-size: 18px;
  }
  #h3{
    font-size: 16px;
  }
  #msg{
    font-size: 15px;
  }
  .msg{
    font-size: 15px;
  }

  .modal {
    position: fixed;
    font-family: Arial, Helvetica, sans-serif;
    top: -110px;
    right: 0;
    bottom: 0;
    left: 0;
    background: rgba(0,0,0,0.8);
    z-index: 99999;
    opacity:0;
    -webkit-transition: opacity 400ms ease-in;
    -moz-transition: opacity 400ms ease-in;
    transition: opacity 400ms ease-in;
    pointer-events: none;
  }

  .modal:target {
    opacity:1;
    pointer-events: auto;
  }

  .modal > div {
    width: 400px;
    position: relative;
    margin: 10% auto;
    padding: 7px 7px 7px 7px;
    border-radius: 10px;
    background: #fff;
    background: -moz-linear-gradient(#fff, #999);
    background: -webkit-linear-gradient(#fff, #999);
    background: -o-linear-gradient(#fff, #999);
  }

  .fechar {
    background: #606061;
    color: #FFFFFF;
    line-height: 20px;
    position: absolute;
    right: -12px;
    text-align: center;
    top: -10px;
    width: 24px;
    text-decoration: none;
    font-weight: bold;
    -webkit-border-radius: 12px;
    -moz-border-radius: 12px;
    border-radius: 12px;
    -moz-box-shadow: 1px 1px 3px #000;
    -webkit-box-shadow: 1px 1px 3px #000;
    box-shadow: 1px 1px 3px #000;
  }

  .fechar:hover { background: #00d9ff; }
</style>