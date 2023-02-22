<?php
session_start();
if(!isset($_SESSION['uid'])){
    $_SESSION['status']="Login first  to be able view this page";
    header('Location:login.php');
}
include 'connection.php';
include "header.php";
?>
<div class="container">
    <style>
        .container{
            display: flex;
            flex-direction: row;
            background:rgba(25,15,255,0.2);
            height:85vh;
        }

    </style>
    <div class="sidebar" style="background-color: #00cec9;">
       <div class="profile" style="display: flex;margin-left:1rem;margin-top:1rem;">
           <img src="readmore1.jpeg" height="55" width="55" style="border-radius: 50%;">
           <p>Abraham Kibet</p>
       </div>

        <button style="background:blue;color:white;border:none;outline-color:pink;margin:1rem;padding:0.5rem;font-size:17px;">MY Profile</button>
        <div class="contents">
            <button style="background:blue;color:white;border:none;outline-color:pink;margin:1rem;padding:0.5rem;font-size:17px;">Chat with us</button>
            <br>

            <button style="background:blue;color:white;border:none;outline-color:pink;margin:1rem;padding:0.5rem;font-size:17px;">Recommendation </button>
            <br>

            <button style="background:blue;color:white;border:none;outline-color:pink;margin:1rem;padding:0.5rem;font-size:17px;">See all Members</button>
            <br>
        </div>


    </div>
    <div class="main-content" style="display:flex;flex-direction:column;align-items: center;margin-left: 2rem">
        <h2>Welcome to Inua Toto Foundation</h2>
        <p>     Inua toto foundation  is a Non-profit organization that help children of the community who  are faced<br>
            with economic challenges and also poor parenting and poverty in general.<br>
            We are dedicated to serve the less previledged in the society <br> we wish that we will come together to help the children
        </p>
    </div>
</div>
