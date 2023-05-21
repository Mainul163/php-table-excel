<?php 



    if(isset($_POST["export_csv_data"])) {	
      


       header('Content-Description: File Transfer');
       header('Content-Type: application/csv');
       header("Content-Disposition: attachment; filename=last-data-export.csv");
       header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
   
        $handle = fopen('php://output','w+');
        ob_clean(); 
        $is_coloumn = true;
        //* ************ascending to descending order start ***************
        array_multisort(array_column( $Last_transactionList, 'F_Status_Info_Id_To'),  SORT_ASC,
        array_column( $Last_transactionList, 'User_Info_Full_Name'), SORT_ASC,
         $Last_transactionList);

         //* ************ascending to descending order end ***************
       if(!empty($Last_transactionList)) {
        foreach($Last_transactionList as $trans) {
         
           
          if($is_coloumn) {		  	  
            fputcsv($handle, array_keys($trans));
            $is_coloumn = false;
          }		
          fputcsv($handle, array_values($trans));
        }
        
      }
   
       ob_flush(); 
       fclose($handle);
       die();
       }
















?>