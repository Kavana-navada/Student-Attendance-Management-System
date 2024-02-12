<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="jquery-3.6.0.min.js"></script>
    <script src="jquery-table2excel-master/dist/jquery.table2excel.min.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="reportcss.css"> -->
   
</head>
<style>
         body{
          background-color:rgb(231, 227, 236);
         }
            img{
              margin-top: 3%;
              height:150px;
              width:150px;
              margin-left:44%;
              background-color:white;
              border-radius:30%;
              padding-left:30px;
              padding-right:30px;
            }
    #download{
       
      background:rgb(82, 188, 153);
        font-size:30px; 
        text-align: center;
        padding-top: 40px;
        margin-top: 2%;
        height:150px;
        width:550px;
        margin-left:33%;
        box-shadow:inset -3px -3px 17px rgb(7, 51, 36),
        5px 5px 10px rgb(0, 0, 0),
        5px 5px 5px rgb(247, 247, 247);
        border-radius:30px;
      
        color:  rgb(3, 57, 88);
    }
  
   a{
            padding: 10px 20px;
            text-decoration:none;
                border-radius: 2px;
        font-size: 1.5rem;
        background: white;
        box-shadow:inset -1px -1px 7px rgb(7, 51, 36),
        3px 3px 5px rgb(0, 0, 0),
        3px 3px 3px rgb(247, 247, 247);
        border: none;
        color:  rgb(3, 57, 88);
        text-transform: uppercase;
        position: relative;
        transition: 0.5s ease;
        cursor: default;
        
        margin-top: 23px;
        font-weight: 600;
        text-align: center;
        justify-content: center;
        border-radius: 5px;
        } 
        a:before{
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        height: 3px;
        width: 0px;
        background-color: transparent;
        transition: 0.4s ease;
        box-shadow: 0 10px 5px rgb(23, 90, 69),0 12px 10px rgb(23, 90, 69),0 15px 20px rgb(23, 90, 69);
        border-radius: 5px;
        }

        a:hover:before{
        width:100%;
                    
        }
        a:hover{
        color: white;
        transition-delay: 0.2s;
        background-color:rgb(23, 90, 69);
        }
    
    </style>
<body>

 
  <table id="myTable" style="display:none;">
        <?php
        echo $_SESSION["exportedTable"];
        ?> 
       <img src="../Pictures/download.png"> 
    <p id="download">Your file has been downloaded........<br><br>
    <a href="staffreport.php" >Back</a></p>
    
    <script>
      // Export table to Excel
      function exportToExcel() {
        $("#myTable").table2excel({
          exclude: ".noExl", // Exclude specific classes or IDs if needed
          filename: "table_data", // Specify the name of the Excel file
          fileext: ".xls", // Specify the file extension (e.g., .xls or .xlsx)
          complete: function() {
            // Redirect to treport.php with a slight delay
            
            window.location.href = "treport.php";
           
          }
        });
      }

      // Automatically export and redirect on page load
      $(document).ready(function() {
        exportToExcel();
      });
    </script>';
    
    
</body>
</html>