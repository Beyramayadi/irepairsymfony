<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\Stream;
use App\Entity\Stock;






class DefaultController extends AbstractController
{
    /**
     * @Route("/export", name="export")
     */
    public function export(Request $request)
    
    {
        $spreadsheet = new Spreadsheet();
        
        /* @var $sheet \PhpOffice\PhpSpreadsheet\Writer\Xlsx\Worksheet */
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'id');
        $sheet->setCellValue('B1', 'nom Article');
        $sheet->setCellValue('C1', 'quantite Article ');
        $sheet->setCellValue('D1', 'prixArticle');
        $sheet->setCellValue('E1', 'nomPole');
        $sheet->setCellValue('F1', 'updatedAt');
        
        $Stocks= $this->getDoctrine()->getRepository(Stock::class)->findAll();
        foreach($Stocks as  $key => $Stock ){
           $i=$key+2;
         $sheet->setCellValue('A'.$i , $Stock->getidArticle());
         $sheet->setCellValue('B'.$i , $Stock->getnomArticle());
         $sheet->setCellValue('C'.$i , $Stock->getquantiteArticle());
         $sheet->setCellValue('D'.$i , $Stock->getprixArticle());
         $sheet->setCellValue('E'.$i , $Stock->getidPole());
         $sheet->setCellValue('F'.$i , $Stock->getUpdatedAt());
        }
        
           
      
           $type=$request->get("type");
           
           
           if($type==='xlsx')
           {
            // Create your Office 2007 Excel (XLSX Format)
              $writer = new xlsx($spreadsheet);
              $filename = 'stock.xlsx';
           
             // In this case, we want to write the file in the public directory
        $publicDirectory = $this->getParameter('kernel.project_dir'). '/public';
        // e.g /var/www/project/public/my_first_excel_symfony4.xlsx
        $excelFilepath =  $publicDirectory . '/stock.xlsx';
        
    
           }
        

        if($type==='xls')
           {
            // Create your Office 2007 Excel (XLSX Format)
              $writer = new xls($spreadsheet);
              $filename = 'stock.xls';
           
             // In this case, we want to write the file in the public directory
        $publicDirectory = $this->getParameter('kernel.project_dir'). '/public';
        // e.g /var/www/project/public/my_first_excel_symfony4.xlsx
        $excelFilepath =  $publicDirectory . '/stock.xls';
        
           }
       

        if($type==='csv')
           {
            // Create your Office 2007 Excel (XLSX Format)
              $writer = new csv($spreadsheet);
             
              $writer->setDelimiter(';');
              $writer->setEnclosure('"');
              $writer->setLineEnding("\r\n");
              $writer->setSheetIndex(0);
              $filename = 'stock.csv';
          
             // In this case, we want to write the file in the public directory
        $publicDirectory = $this->getParameter('kernel.project_dir'). '/public';
        // e.g /var/www/project/public/my_first_excel_symfony4.xlsx
        $excelFilepath =  $publicDirectory . '/stock.csv';
        
        
        $writer->save($excelFilepath);
        $stream = new Stream($excelFilepath );
        $response = new BinaryFileResponse($stream);
        $response->headers->set('Content-Type', 'text/csv');
        //it's gonna output in a testing.csv file
        $response->headers->set('Content-Disposition', 'attachment; filename="Stock.csv"');
      return $response;
       
           }
       
      
           $writer->save($excelFilepath);
           $stream = new Stream($excelFilepath );
           $response = new BinaryFileResponse($stream);
         return $response;
        
           
            
       
        
      
      
    }
}
