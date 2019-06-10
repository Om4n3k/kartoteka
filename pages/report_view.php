<?php
   $report = $core->getReportValues($_GET['id']);
   $policeman = $core->getUserData($report['policeman_id']);
   $report['date'] = date("H:i d.m.Y",$report['date']);
?>
<div class="container-fluid">
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Raport</h1>
   </div>
   <div class="card mb-12">
      <div class="card-header">
         <span class="float-center">Tytułem: <?=$report['title']?></span>
         <span class="float-right">Dodano: <?=$report['date']?></span>
      </div>
      <div class="card-body">
         <?=str_replace(array("\r\n", "\r", "\n"), "<br />", $report['text'])?>
      </div>
      <div class="card-footer">
         Raport od: <?=$policeman['name'].' '.$policeman['surname']?>
      </div>
   </div>
</div>