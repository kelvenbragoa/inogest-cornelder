<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
  

    <style type="text/css">
        @page {
            margin: 0px;
        }
        .break-page{
          page-break-after: always;
        }
        body {
            margin: 5px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice {
            margin: 30px;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
            background-color: #19a1f5;
            color: #000;
            margin: 5px;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
        .body {
            margin: 30px;
        }
        table , tr , td{
        border:1px solid black;
        border-collapse: collapse;
}
    </style>

</head>
<body>

<div class="information" style="background-color: #fff;">
    <img src="http://inosecure.inovatis.co.mz/storage/sys/cdm.png" alt="Logo" width="120" class="logo"/>
     <h3>Cornelder de Moçambique</h3>
     <p>Data: {{$meeting->created_at->format('d-m-Y')}}</p>
   
</div>


<br/>



<div class="invoice">
    <h3 style="text-align: center">ACTA DA REUNIÃO</h3>
     <div class="body">
        {!! $meeting->body !!}
    </div>
     <table width="95%">
       
        
         <tr>
            <td colspan="5" align="center" style="background-color: #19a1f5">ASSUNTO</td>
         </tr>

         <tr>
            <td  colspan="5" align="center" style="background-color: #f0f0f0">{{$meeting->subject}}</td>
           
         </tr>

         <tr>
            <td colspan="5" align="center" style="background-color: #19a1f5">PARTICIPANTES DA REUNIÃO</td>
         </tr>

         <tr>
            <td  style="background-color: #f0f0f0">Nome</td>
            <td  style="background-color: #f0f0f0">Email</td>
            <td  colspan="3" style="background-color: #f0f0f0">Obs</td>
         </tr>
         @foreach ($meeting->participants as $item)
         <tr>
            <td  style="background-color: #f0f0f0">{{$item->name}}</td>
            <td  style="background-color: #f0f0f0">{{$item->email}}</td>
            <td  colspan="3" style="background-color: #f0f0f0">{{$item->obs}}</td>
         </tr>
         @endforeach

         <tr>
            <td colspan="5" align="center" style="background-color: #19a1f5">ATIVIDADES DA REUNIÃO</td>
         </tr>

         <tr>
            <td  style="background-color: #f0f0f0">Quem</td>
            <td  style="background-color: #f0f0f0">Quando</td>
            {{-- <td  style="background-color: #f0f0f0">Estado</td> --}}
            <td  colspan="3" style="background-color: #f0f0f0">Oque</td>
         </tr>
         @foreach ($meeting->tasks as $item)
         <tr>
            <td  style="background-color: #f0f0f0">{{$item->participant->name}} <br>({{$item->participant->email}})</td>
            <td  style="background-color: #f0f0f0">{{date('d-m-Y',strtotime($item->when))}}</td>
            <td  colspan="3" @if ($item->status == 1) style="background-color: #09c67d" @else style="background-color: #ee4646" @endif >@if ($item->status == 1) (Terminado) @else (Pendente) @endif {{$item->what}}</td>
            {{-- <td  style="background-color: #f0f0f0">{{$item->what}}</td> --}}
         </tr>
         @endforeach

    
{{--
        <tr>
          <td colspan="5" align="center" style="background-color: #bdbdbd">CORPO DA REUNIÃO</td>
        </tr>

        <tr>
         
          <td colspan="5"> {!! $meeting->body !!}</td>
         
       </tr>
     

         <tr>
          <td style="background-color: #f0f0f0">NOME</td>
          <td>{{ $occurance->name_involved }}</td>
          <td style="background-color: #f0f0f0">CONTACTO</td>
          <td>{{ $occurance->contact_involved }}</td>
       </tr>

       <tr>
          <td style="background-color: #f0f0f0">IDENTIFICAÇÃO</td>
          <td>{{ $occurance->id_involved }}</td>
          <td style="background-color: #f0f0f0">PROFISSÃO</td>
          <td>{{ $occurance->profession_involved }}</td>
      </tr>


      
      <tr>
        <td colspan="4" align="center" style="background-color: #bdbdbd">SECÇÃO 4 - DESCRIÇÃO DO INCIDENTE</td>
      </tr>

      <tr>
       
        <td colspan="4">* {{ $occurance->description }}</td>
       
      </tr> --}}
    </table>
   
    






</div>



 <div class="information" style="position: absolute; bottom: 0; width:100%">
   <p style="color: black; font-size:10px; text-align:center">&copy; {{ date('Y') }} INOVATIS MZ LTD - Todos Direitos Reservados.InoGest,Impulsionando a Gestão.</p>    
</div> 
</body>
</html>
