<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Admin</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.ico') }}">

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/morris/morris.css') }}">

    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('admin/assets/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/icons.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('admin/assets/css/style.css') }}" rel="stylesheet" type="text/css">


</head>
<body>

    {{--Page Specific Content--}}
    <div class="panel panel-primary">

        <div class="panel-heading">

            <h3 class="panel-title" style="padding:12px 0px;font-size:25px;"><strong>Laravel 5.3 - import export csv or excel file into database example</strong></h3>

        </div>

        <div class="panel-body">


            @if ($message = Session::get('success'))

                <div class="alert alert-success" role="alert">

                    {{ Session::get('success') }}

                </div>

            @endif


            @if ($message = Session::get('error'))

                <div class="alert alert-danger" role="alert">

                    {{ Session::get('error') }}

                </div>

            @endif


            <h3>Import File Form:</h3>

            <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 20px;" action="{{ route('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">


                <input type="file" name="import_file" />

                {{ csrf_field() }}

                <br/>


                <button class="btn btn-primary">Import CSV or Excel File</button>


            </form>

            <br/>


        </div>

    </div>

<table id="example">
 <thead>
 <tr  height=21 style='height:15.5pt'>
  <th>S.No.</th>
  <th>question</th>
  <th>option_A</th>
  <th>option_B</th>
  <th>option_C</th>
  <th>option_D</th>
  <th>correct</th>
 </tr>
 </thead>
 <tbody>
    <tr height=26 style='height:19.5pt'>
        <td height=26 class=xl673672 style='height:19.5pt;border-top:none'>1</td>
        <td class=xl653672 style='border-top:none;border-left:none'>In the rea<span
        style='display:none'>ction, NH<font class="font63672"><sub>2</sub></font><font
        class="font53672"> + H</font><font class="font63672"><sub>2</sub></font><font
        class="font53672">O &#8776; NH</font><font class="font63672"><sub>4</sub></font><font
        class="font73672"><sup>+</sup></font><font class="font53672"> + OH</font><font
        class="font73672"><sup>-</sup></font><font class="font53672">, which of the
        following constitutes conjugate acid base pair?<span
        style='mso-spacerun:yes'> </span></font></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>NH<font
        class="font63672"><sub>3</sub></font><font class="font53672"> and </font><span
        style='display:none'><font class="font53672">H</font><font class="font63672"><sub>2</sub></font><font
        class="font53672">O</font></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>NH<font
        class="font63672"><sub>4</sub></font><font class="font53672">+ and</font><span
        style='display:none'><font class="font53672"> OH</font><font class="font73672"><sup>-</sup></font><font
        class="font53672"><span style='mso-spacerun:yes'> </span></font></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>H<font
        class="font63672"><sub>2</sub></font><font class="font53672">O and </font><span
        style='display:none'><font class="font53672">OH</font><font class="font73672"><sup>-</sup></font><font
        class="font53672"><span style='mso-spacerun:yes'> </span></font></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>NH<font
        class="font63672"><sub>3</sub></font><font class="font53672"> and </font><span
        style='display:none'><font class="font53672">OH</font><font class="font73672"><sup>-</sup></font></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>c<span
        style='mso-spacerun:yes'> </span></td>
       </tr>
       <tr height=21 style='height:15.5pt'>
        <td height=21 class=xl673672 style='height:15.5pt;border-top:none'>2</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Accordin<span
        style='display:none'>g to Bronsted Lowry concept, and acid is said to be
        strong if</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Cojugate b<span
        style='display:none'>ase is stron</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Conjugate <span
        style='display:none'>base is weak<span style='mso-spacerun:yes'> </span></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Conjugate <span
        style='display:none'>base doesn't exist</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>None of a<span
        style='display:none'>bove</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>b</td>
       </tr>
       <tr height=26 style='height:19.5pt'>
        <td height=26 class=xl673672 style='height:19.5pt;border-top:none'>3</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Which of <span
        style='display:none'>the following is strongest conjugate base?</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>NO<font
        class="font63672"><sub>3</sub></font><font class="font73672"><sup>-</sup></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>SO<font
        class="font63672"><sub>4</sub></font><font class="font73672"><sup>- -</sup></font><font
        class="font53672"><span style='mso-spacerun:yes'> </span></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>CH<font
        class="font73672"><sup>3</sup></font><font class="font53672">COO</font><font
        class="font73672"><sup>-</sup></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>CI<font
        class="font73672"><sup>-</sup></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>c<span
        style='mso-spacerun:yes'> </span></td>
       </tr>
       <tr height=21 style='height:15.5pt'>
        <td height=21 class=xl673672 style='height:15.5pt;border-top:none'>4</td>
        <td class=xl663672 style='border-top:none;border-left:none'>Alum is<span
        style='mso-spacerun:yes'> </span></td>
        <td class=xl663672 style='border-top:none;border-left:none'>Double sal<span
        style='display:none'>t</span></td>
        <td class=xl663672 style='border-top:none;border-left:none'>Mixed salt</td>
        <td class=xl663672 style='border-top:none;border-left:none'>Common s<span
        style='display:none'>alt</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Potash salt</td>
        <td class=xl653672 style='border-top:none;border-left:none'>a</td>
       </tr>
       <tr height=21 style='height:15.5pt'>
        <td height=21 class=xl673672 style='height:15.5pt;border-top:none'>5</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Water hs <span
        style='display:none'>pH = 7. A salt is added to it even through the pH of
        solution remains same. The salt is made up of</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>String acid<span
        style='display:none'> + strong base</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Strong aci<span
        style='display:none'>d + weak base</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Strong bas<span
        style='display:none'>e + weak acid<span style='mso-spacerun:yes'> </span></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Weak acid<span
        style='display:none'> + weak base</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>a</td>
       </tr>
       <tr height=26 style='height:19.5pt'>
        <td height=26 class=xl673672 style='height:19.5pt;border-top:none'>6</td>
        <td class=xl653672 style='border-top:none;border-left:none'>In the foll<span
        style='display:none'>owing equilibrium: HCI + H<font class="font63672"><sub>2</sub></font><font
        class="font53672">O </font><font class="font93672">&#8776;</font><font
        class="font53672"> H</font><font class="font63672"><sub>3</sub></font><font
        class="font53672">O</font><font class="font73672"><sup>+</sup></font><font
        class="font53672"> + CI</font><font class="font73672"><sup>-</sup></font><font
        class="font53672">, H</font><font class="font73672"><sup>2</sup></font><font
        class="font53672">O is base according to<span
        style='mso-spacerun:yes'> </span></font></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Classical c<span
        style='display:none'>oncept</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Arrhenius <span
        style='display:none'>concept</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Bronsted -<span
        style='display:none'> Lowery concept</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Lewis con<span
        style='display:none'>cept</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>c<span
        style='mso-spacerun:yes'> </span></td>
       </tr>
       <tr height=21 style='height:15.5pt'>
        <td height=21 class=xl673672 style='height:15.5pt;border-top:none'>1</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Accordin<span
        style='display:none'>g to Arrhenius, acids are<span
        style='mso-spacerun:yes'> </span></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>proton acc<span
        style='display:none'>eptors</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Compoun<span
        style='display:none'>ds which give hydrogen ion</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Proton do<span
        style='display:none'>nor<span style='mso-spacerun:yes'> </span></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Compound<span
        style='display:none'>s withch give hydroxyl ion</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>B</td>
       </tr>
       <tr height=21 style='height:15.5pt'>
        <td height=21 class=xl673672 style='height:15.5pt;border-top:none'>2</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Accordin<span
        style='display:none'>g to lewis concept, an acid is a substance which</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>accepts pr<span
        style='display:none'>oton</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>donates pr<span
        style='display:none'>oton</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>accepts a l<span
        style='display:none'>one pair of electrons</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>donates a l<span
        style='display:none'>one pair of electrons</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>c<span
        style='mso-spacerun:yes'> </span></td>
       </tr>
       <tr height=23 style='height:17.5pt'>
        <td height=23 class=xl673672 style='height:17.5pt;border-top:none'>3</td>
        <td class=xl653672 style='border-top:none;border-left:none'>BF<font
        class="font63672"><sub>3</sub></font><font class="font53672"> mole</font><span
        style='display:none'><font class="font53672">culeis<span
        style='mso-spacerun:yes'> </span></font></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Lweis acid<span
        style='display:none'><span style='mso-spacerun:yes'> </span></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Lewis bas<span
        style='display:none'>e</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Neutral sal<span
        style='display:none'>t</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>None of th<span
        style='display:none'>ese</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>A</td>
       </tr>
       <tr height=21 style='height:15.5pt'>
        <td height=21 class=xl673672 style='height:15.5pt;border-top:none'>4</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Water is a<span
        style='display:none'><span style='mso-spacerun:yes'> </span></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Protophob<span
        style='display:none'>ic solvent<span style='mso-spacerun:yes'> </span></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>protophilic<span
        style='display:none'> solvent<span style='mso-spacerun:yes'> </span></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>amphiproti<span
        style='display:none'>c solvent</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>aprotic sol<span
        style='display:none'>vent</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>c<span
        style='mso-spacerun:yes'> </span></td>
       </tr>
       <tr height=23 style='height:17.5pt'>
        <td height=23 class=xl673672 style='height:17.5pt;border-top:none'>5</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Which of <span
        style='display:none'>the following is not a protonic acid?</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>PO(OH)<font
        class="font63672"><sub>3</sub></font><font class="font53672"><span
        style='mso-spacerun:yes'> </span></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>SO(OH)<font
        class="font63672"><sub>2</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>SO<font
        class="font63672"><sub>2</sub></font><font class="font53672">(OH)</font><font
        class="font63672"><sub>2</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>B(OH)<font
        class="font63672"><sub>3</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>D</td>
       </tr>
       <tr height=26 style='height:19.5pt'>
        <td height=26 class=xl673672 style='height:19.5pt;border-top:none'>6</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Accordin<span
        style='display:none'>g to Lewis concept which one of the following is not a
        base?<span style='mso-spacerun:yes'> </span></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>OH<font
        class="font73672"><sup>-</sup></font><font class="font53672"><span
        style='mso-spacerun:yes'> </span></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>H<font
        class="font63672"><sub>2</sub></font><font class="font53672">O</font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Ag<font
        class="font63672"><sub>+</sub></font><font class="font53672"><span
        style='mso-spacerun:yes'> </span></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>NH<font
        class="font63672"><sub>3</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>c<span
        style='mso-spacerun:yes'> </span></td>
       </tr>
       <tr height=23 style='height:17.5pt'>
        <td height=23 class=xl673672 style='height:17.5pt;border-top:none'>7</td>
        <td class=xl653672 style='border-top:none;border-left:none'>An exam<span
        style='display:none'>ple of Lewis acid is</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>PCI<font
        class="font63672"><sub>3</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>NCI<font
        class="font63672"><sub>3</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>AICI<font
        class="font63672"><sub>3</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>CCI<font
        class="font63672"><sub>4</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>c<span
        style='mso-spacerun:yes'> </span></td>
       </tr>
       <tr height=26 style='height:19.5pt'>
        <td height=26 class=xl673672 style='height:19.5pt;border-top:none'>8</td>
        <td class=xl653672 style='border-top:none;border-left:none'>In the rea<span
        style='display:none'>ction SnCI<font class="font63672"><sub>2 </sub></font><font
        class="font53672">+ 2CI</font><font class="font73672"><sup>-</sup></font><font
        class="font53672"> </font><font class="font83672">&#8594;</font><font
        class="font53672"> SnCI</font><font class="font63672"><sub>4</sub></font><font
        class="font53672">, Lewis acid is<span style='mso-spacerun:yes'> </span></font></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>SnCI<font
        class="font63672"><sub>2</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>CI<font
        class="font73672"><sup>-</sup></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>SnCI<font
        class="font63672"><sub>4</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>None of th<span
        style='display:none'>e three</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>a</td>
       </tr>
       <tr height=26 style='height:19.5pt'>
        <td height=26 class=xl673672 style='height:19.5pt;border-top:none'>9</td>
        <td class=xl653672 style='border-top:none;border-left:none'>CI<font
        class="font73672"><sup>-</sup></font><font class="font53672"> is a c</font><span
        style='display:none'><font class="font53672">onjugate base of which acid?</font></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>HCI</td>
        <td class=xl653672 style='border-top:none;border-left:none'>HOCI</td>
        <td class=xl653672 style='border-top:none;border-left:none'>HCIO<font
        class="font63672"><sub>3</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>H<font
        class="font63672"><sub>3</sub></font><font class="font53672">O</font><font
        class="font73672"><sup>+</sup></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>a</td>
       </tr>
       <tr height=26 style='height:19.5pt'>
        <td height=26 class=xl673672 style='height:19.5pt;border-top:none'>10</td>
        <td class=xl653672 style='border-top:none;border-left:none'>The conju<span
        style='display:none'>gate acid of H<font class="font63672"><sub>2</sub></font><font
        class="font53672">PO</font><font class="font73672"><sup>-</sup></font><font
        class="font63672"><sub>4</sub></font><font class="font53672"> is</font></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>H<font
        class="font63672"><sub>3</sub></font><font class="font53672">PO</font><font
        class="font63672"><sub>4</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>H<font
        class="font63672"><sub>2</sub></font><font class="font53672">PO</font><font
        class="font63672"><sub>4</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>PO<font
        class="font73672"><sup>3-</sup></font><font class="font63672"><sub>4</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>H<font
        class="font103672"><sub>3</sub></font><font class="font53672">O</font><font
        class="font73672"><sup>+</sup></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>a</td>
       </tr>
       <tr height=26 style='height:19.5pt'>
        <td height=26 class=xl673672 style='height:19.5pt;border-top:none'>11</td>
        <td class=xl653672 style='border-top:none;border-left:none'>The conju<span
        style='display:none'>gate acid of HPO<font class="font73672"><sup>2-</sup></font><font
        class="font63672"><sub>4</sub></font><font class="font53672"> is<span
        style='mso-spacerun:yes'> </span></font></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>H<font
        class="font63672"><sub>2</sub></font><font class="font53672">PO</font><font
        class="font73672"><sup>-</sup></font><font class="font63672"><sub>4</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>PO<font
        class="font73672"><sup>3-</sup></font><font class="font63672"><sub>4</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>H<font
        class="font73672"><sup>3</sup></font><font class="font53672">PO</font><font
        class="font63672"><sub>4</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>H<font
        class="font63672"><sub>3</sub></font><font class="font53672">PO</font><font
        class="font63672"><sub>3</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>a</td>
       </tr>
       <tr height=23 style='height:17.5pt'>
        <td height=23 class=xl673672 style='height:17.5pt;border-top:none'>12</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Ammonia<span
        style='display:none'> gas dissolves in water to give HN<font class="font63672"><sub>4</sub></font><font
        class="font53672">OH. In this reaction, water acts as<span
        style='mso-spacerun:yes'> </span></font></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>An acid<span
        style='mso-spacerun:yes'> </span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>A base</td>
        <td class=xl653672 style='border-top:none;border-left:none'>A salt</td>
        <td class=xl653672 style='border-top:none;border-left:none'>A conjugat<span
        style='display:none'>e base</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>a</td>
       </tr>
       <tr height=26 style='height:19.5pt'>
        <td height=26 class=xl673672 style='height:19.5pt;border-top:none'>13</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Which of <span
        style='display:none'>the following species is an acid and also a conjugate
        base of another acid?<span style='mso-spacerun:yes'> </span></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>HSO<font
        class="font73672"><sup>-</sup></font><font class="font63672"><sub>4</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>H<font
        class="font63672"><sub>2</sub></font><font class="font53672">SO</font><font
        class="font63672"><sub>4</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>OH<font
        class="font73672"><sup>-</sup></font><font class="font53672"><span
        style='mso-spacerun:yes'> </span></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>H<font
        class="font63672"><sub>3</sub></font><font class="font53672">O</font><font
        class="font73672"><sup>+</sup></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>a</td>
       </tr>
       <tr height=23 style='height:17.5pt'>
        <td height=23 class=xl673672 style='height:17.5pt;border-top:none'>14</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Which of <span
        style='display:none'>the following is the strongest acid?<span
        style='mso-spacerun:yes'> </span></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>H<font
        class="font63672"><sub>3</sub></font><font class="font53672">PO</font><font
        class="font63672"><sub>4</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>H<font
        class="font63672"><sub>2</sub></font><font class="font53672">SO</font><font
        class="font63672"><sub>4</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>HNO<font
        class="font63672"><sub>2</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>CH<font
        class="font63672"><sub>3</sub></font><font class="font53672">COO</font><span
        style='display:none'><font class="font53672">H</font></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>b</td>
       </tr>
       <tr height=23 style='height:17.5pt'>
        <td height=23 class=xl673672 style='height:17.5pt;border-top:none'>15</td>
        <td class=xl653672 style='border-top:none;border-left:none'>With refe<span
        style='display:none'>rence to protonic acids, which of the following
        statements is correct?<span style='mso-spacerun:yes'> </span></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Ph<font
        class="font63672"><sub>3</sub></font><font class="font53672"> is mor</font><span
        style='display:none'><font class="font53672">e basic than NH</font><font
        class="font63672"><sub>3</sub></font></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Ph<font
        class="font63672"><sub>3</sub></font><font class="font53672"> is less</font><span
        style='display:none'><font class="font53672"> basic than NH</font><font
        class="font63672"><sub>3</sub></font></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Ph<font
        class="font63672"><sub>3</sub></font><font class="font53672"> is equ</font><span
        style='display:none'><font class="font53672">ally basic than NH</font><font
        class="font63672"><sub>3</sub></font></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Ph<font
        class="font63672"><sub>3</sub></font><font class="font53672"> is is a</font><span
        style='display:none'><font class="font53672">mphoteric while NH</font><font
        class="font63672"><sub>3 </sub></font><font class="font53672">is basic</font></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>b</td>
       </tr>
       <tr height=23 style='height:17.5pt'>
        <td height=23 class=xl673672 style='height:17.5pt;border-top:none'>16</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Which of <span
        style='display:none'>the following has highest proton affinity?</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>NH<font
        class="font63672"><sub>3</sub></font><font class="font53672"><span
        style='mso-spacerun:yes'> </span></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>H<font
        class="font63672"><sub>2</sub></font><font class="font53672">O</font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>H<font
        class="font63672"><sub>2</sub></font><font class="font53672">S</font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>PH<font
        class="font63672"><sub>3</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>a</td>
       </tr>
       <tr height=26 style='height:19.5pt'>
        <td height=26 class=xl673672 style='height:19.5pt;border-top:none'>17</td>
        <td class=xl653672 style='border-top:none;border-left:none'>The stron<span
        style='display:none'>gest lewis base among the following is<span
        style='mso-spacerun:yes'> </span></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>CH<font
        class="font73672"><sup>-</sup></font><font class="font63672"><sub>3</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>F<font
        class="font73672"><sup>-</sup></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>NH<font
        class="font73672"><sup>-</sup></font><font class="font63672"><sub>2</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>OH<font
        class="font73672"><sup>-</sup></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>a</td>
       </tr>
       <tr height=26 style='height:19.5pt'>
        <td height=26 class=xl673672 style='height:19.5pt;border-top:none'>18</td>
        <td class=xl653672 style='border-top:none;border-left:none'>The stron<span
        style='display:none'>gest Bronsted base in the following anion is<span
        style='mso-spacerun:yes'> </span></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>CIO<font
        class="font73672"><sup>-</sup></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>CIO<font
        class="font73672"><sup>-</sup></font><font class="font63672"><sub>2</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>CIO<font
        class="font73672"><sup>-</sup></font><font class="font63672"><sub>3</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>CIO<font
        class="font73672"><sup>-</sup></font><font class="font63672"><sub>4</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>a</td>
       </tr>
       <tr height=21 style='height:15.5pt'>
        <td height=21 class=xl673672 style='height:15.5pt;border-top:none'>19</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Boron co<span
        style='display:none'>mpounds behave as Lewis acid because of their</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>acidic natr<span
        style='display:none'>ue</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>convalent <span
        style='display:none'>natrue</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>electron d<span
        style='display:none'>eficiency</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>ionization <span
        style='display:none'>property</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>c<span
        style='mso-spacerun:yes'> </span></td>
       </tr>
       <tr height=26 style='height:19.5pt'>
        <td height=26 class=xl673672 style='height:19.5pt;border-top:none'>20</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Ionization<span
        style='display:none'> of HCI in watr results in the formation of<span
        style='mso-spacerun:yes'> </span></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>H<font
        class="font73672"><sup>+</sup></font><font class="font53672"> ion an</font><span
        style='display:none'><font class="font53672">d CI</font><font
        class="font73672"><sup>-</sup></font><font class="font53672"> ion</font></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>H<font
        class="font63672"><sub>3</sub></font><font class="font53672">O</font><font
        class="font73672"><sup>+</sup></font><font class="font53672"> ion </font><span
        style='display:none'><font class="font53672">and CI</font><font
        class="font73672"><sup>-</sup></font><font class="font53672"> ion</font></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>H<font
        class="font73672"><sup>+</sup></font><font class="font53672"> ion, O</font><span
        style='display:none'><font class="font53672">H</font><font class="font73672"><sup>-</sup></font><font
        class="font53672"> ion and Ciion<span style='mso-spacerun:yes'> </span></font></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>HCIO<font
        class="font73672"><sup>-</sup></font><font class="font53672">ion</font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>b</td>
       </tr>
       <tr height=26 style='height:19.5pt'>
        <td height=26 class=xl673672 style='height:19.5pt;border-top:none'>21</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Cnjugate <span
        style='display:none'>base of HCO<font class="font73672"><sup>-</sup></font><font
        class="font63672"><sub>3</sub></font><font class="font53672"> is<span
        style='mso-spacerun:yes'> </span></font></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>CO<font
        class="font73672"><sup>2-</sup></font><font class="font63672"><sub>3</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>H<font
        class="font63672"><sub>2</sub></font><font class="font53672">CO</font><font
        class="font63672"><sub>3</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>H<font
        class="font63672"><sub>2</sub></font><font class="font53672">O<span
        style='mso-spacerun:yes'> </span></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>CO<font
        class="font63672"><sub>2</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>a</td>
       </tr>
       <tr height=23 style='height:17.5pt'>
        <td height=23 class=xl673672 style='height:17.5pt;border-top:none'>22</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Which of <span
        style='display:none'>the following is the weakest<span
        style='mso-spacerun:yes'>  </span>base?</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>NaOH</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Ca(OH)<font
        class="font63672"><sub>2</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>KOH</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Zn(OH)<font
        class="font63672"><sub>2</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>d</td>
       </tr>
       <tr height=23 style='height:17.5pt'>
        <td height=23 class=xl673672 style='height:17.5pt;border-top:none'>23</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Which of <span
        style='display:none'>the following is the strongest acid?<span
        style='mso-spacerun:yes'> </span></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>CIO<font
        class="font63672"><sub>3</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>CIO<font
        class="font63672"><sub>2</sub></font><font class="font53672">(OH)</font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>SO(OH)<font
        class="font63672"><sub>2</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>SO<font
        class="font63672"><sub>2</sub></font><font class="font53672">(OH)</font><font
        class="font63672"><sub>2</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>a</td>
       </tr>
       <tr height=23 style='height:17.5pt'>
        <td height=23 class=xl673672 style='height:17.5pt;border-top:none'>24</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Which of <span
        style='display:none'>the following is the strongest acid?<span
        style='mso-spacerun:yes'> </span></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>HCIO<font
        class="font63672"><sub>2</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>HCIO<font
        class="font63672"><sub>3</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>HCIO<font
        class="font63672"><sub>4</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>HCIO</td>
        <td class=xl653672 style='border-top:none;border-left:none'>c<span
        style='mso-spacerun:yes'> </span></td>
       </tr>
       <tr height=23 style='height:17.5pt'>
        <td height=23 class=xl673672 style='height:17.5pt;border-top:none'>25</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Which is t<span
        style='display:none'>he strongest b ase among the follwing?</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>MG(OH)<font
        class="font63672"><sub>2</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>AI(OH)<font
        class="font63672"><sub>3</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>NaOH</td>
        <td class=xl653672 style='border-top:none;border-left:none'>KOH</td>
        <td class=xl653672 style='border-top:none;border-left:none'>d</td>
       </tr>
       <tr height=26 style='height:19.5pt'>
        <td height=26 class=xl673672 style='height:19.5pt;border-top:none'>26</td>
        <td class=xl653672 style='border-top:none;border-left:none'>In the rea<span
        style='display:none'>ction I<font class="font63672"><sub>2</sub></font><font
        class="font53672"> + I</font><font class="font73672"><sup>-</sup></font><font
        class="font53672"> </font><font class="font83672">&#8594;</font><font
        class="font53672"> I</font><font class="font73672"><sup>-</sup></font><font
        class="font63672"><sub>3</sub></font><font class="font53672">, the Lewis base
        is<span style='mso-spacerun:yes'> </span></font></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>I<font
        class="font63672"><sub>2</sub></font><font class="font53672">(b)</font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>I<font
        class="font73672"><sup>-</sup></font><font class="font53672"><span
        style='mso-spacerun:yes'> </span></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>I<font
        class="font73672"><sup>-</sup></font><font class="font63672"><sub>3</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>None of th<span
        style='display:none'>ese</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>b</td>
       </tr>
       <tr height=26 style='height:19.5pt'>
        <td height=26 class=xl673672 style='height:19.5pt;border-top:none'>27</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Which of <span
        style='display:none'>the following can act both as Bronsted acid and a
        Bronsted base?</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Na<font
        class="font63672"><sub>2</sub></font><font class="font53672">CO</font><font
        class="font63672"><sub>3</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>OH<font
        class="font73672"><sup>-</sup></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>HCO<font
        class="font73672"><sup>-</sup></font><font class="font63672"><sub>3</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>NH<font
        class="font63672"><sub>3</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>c<span
        style='mso-spacerun:yes'> </span></td>
       </tr>
       <tr height=21 style='height:15.5pt'>
        <td height=21 class=xl673672 style='height:15.5pt;border-top:none'>28</td>
        <td class=xl653672 style='border-top:none;border-left:none'>BF3 is aci<span
        style='display:none'>d according to<span style='mso-spacerun:yes'> </span></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Arrhenius</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Lewis<span
        style='mso-spacerun:yes'> </span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Bronsted a<span
        style='display:none'>nd Lowry</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>All of thes<span
        style='display:none'>e</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>b</td>
       </tr>
       <tr height=21 style='height:15.5pt'>
        <td height=21 class=xl673672 style='height:15.5pt;border-top:none'>29</td>
        <td class=xl653672 style='border-top:none;border-left:none'>When rai<span
        style='display:none'>n is accompained by a thunderstorm, the collected rain
        water will have pH value</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>slightly hig<span
        style='display:none'>her thean that when the thunderstorm is not there<span
        style='mso-spacerun:yes'> </span></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>uninfluenc<span
        style='display:none'>ed<span style='mso-spacerun:yes'>  </span>by occurrence
        of thunderstorm<span style='mso-spacerun:yes'> </span></span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>depending<span
        style='display:none'> upon the amount of dust in air</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>slightly lo<span
        style='display:none'>wer than that of rain water without thunderstorm</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>d</td>
       </tr>
       <tr height=23 style='height:17.5pt'>
        <td height=23 class=xl673672 style='height:17.5pt;border-top:none'>30</td>
        <td class=xl653672 style='border-top:none;border-left:none'>Which on<span
        style='display:none'>eis not a Lewis acid?</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>BeF<font
        class="font63672"><sub>2</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>SnCI<font
        class="font63672"><sub>4</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>AICI<font
        class="font63672"><sub>3</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>BF<font
        class="font63672"><sub>3</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>b</td>
       </tr>
       <tr height=23 style='height:17.5pt'>
        <td height=23 class=xl673672 style='height:17.5pt;border-top:none'>31</td>
        <td class=xl653672 style='border-top:none;border-left:none'>For every<span
        style='display:none'> diprotic acid of the type H2X, which of the following
        is true?</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Ka<font
        class="font63672"><sub>2</sub></font><font class="font53672"> &lt; Ka</font><font
        class="font63672"><sub>1</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Ka<font
        class="font63672"><sub>1</sub></font><font class="font53672"> &lt; Ka</font><font
        class="font63672"><sub>2</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Ka<font
        class="font63672"><sub>1</sub></font><font class="font53672"> = Ka</font><font
        class="font63672"><sub>2</sub></font></td>
        <td class=xl653672 style='border-top:none;border-left:none'>Data is ins<span
        style='display:none'>ufficient</span></td>
        <td class=xl653672 style='border-top:none;border-left:none'>a</td>
       </tr>
 </tbody>
</table>


    </div>
    <button onclick="exportTableToExcel()">Export Table Data To Excel File</button>





<!-- jQuery  -->
<script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/modernizr.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/detect.js') }}"></script>
<script src="{{ asset('admin/assets/js/fastclick.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery.blockUI.js') }}"></script>
<script src="{{ asset('admin/assets/js/waves.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery.scrollTo.min.js') }}"></script>

<script src="{{ asset('admin/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<!-- skycons -->
<script src="{{ asset('admin/assets/plugins/skycons/skycons.min.js') }}"></script>

<!-- skycons -->
<script src="{{ asset('admin/assets/plugins/peity/jquery.peity.min.js') }}"></script>

<!--Morris Chart-->
<script src="{{ asset('admin/assets/plugins/morris/morris.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/raphael/raphael-min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- dashboard -->
<script src="{{ asset('admin/assets/pages/dashboard.js') }}"></script>
<!-- App js -->
<script src="{{ asset('admin/assets/js/app.js') }}"></script>


<script type="text/javascript">


var Text = " this contains   spaces ";
Text = Text.replace(/ {1,}/g," ");
Text = Text.trim();
console.log(Text)
    function exportTableToExcel(){
        var table = $('#example');
        var rows = table.find('tr');
        var data = [];
        rows.each(function(){
            var rows = [];
            var cols = $(this).find('td');
            // var ques = String($(cols[1]).html());
            var ques = $(cols[1]);
            ques.find("span").each(function(index) {
                var text = $(this).html();//get span content
                $(this).replaceWith(text);//replace all span with just content
            });
            ques.find("font").each(function(index) {
                var text = $(this).html();//get span content
                $(this).replaceWith(text);//replace all span with just content
            });
            ques = String(ques.html());//get back new string

            ques = ques.replace(/\n|\r/g, ""); // Remove Line Break from string
            ques = ques.replace(/ {1,}/g," ");
            ques = ques.trim();
            rows.push(ques);

            // var option_A = String($(cols[2]).html());
            var option_A = $(cols[2]);
            option_A.find("span").each(function(index) {
                var text = $(this).html();//get span content
                $(this).replaceWith(text);//replace all span with just content
            });
            option_A.find("font").each(function(index) {
                var text = $(this).html();//get span content
                $(this).replaceWith(text);//replace all span with just content
            });
            option_A = String(option_A.html());//get back new string


            option_A = option_A.replace(/\n|\r/g, ""); // Remove Line Break from string
            option_A = option_A.replace(/ {1,}/g," ");
            option_A = option_A.trim();
            rows.push(option_A);


            // var option_B = String($(cols[3]).html());
            var option_B = $(cols[3]);
            option_B.find("span").each(function(index) {
                var text = $(this).html();//get span content
                $(this).replaceWith(text);//replace all span with just content
            });
            option_B.find("font").each(function(index) {
                var text = $(this).html();//get span content
                $(this).replaceWith(text);//replace all span with just content
            });
            option_B = String(option_B.html());//get back new string


            option_B = option_B.replace(/\n|\r/g, ""); // Remove Line Break from string
            option_B = option_B.replace(/ {1,}/g," ");
            option_B = option_B.trim();
            rows.push(option_B);

            // var option_C = String($(cols[4]).html());
            var option_C = $(cols[4]);
            option_C.find("span").each(function(index) {
                var text = $(this).html();//get span content
                $(this).replaceWith(text);//replace all span with just content
            });
            option_C.find("font").each(function(index) {
                var text = $(this).html();//get span content
                $(this).replaceWith(text);//replace all span with just content
            });
            option_C = String(option_C.html());//get back new string

            option_C = option_C.replace(/\n|\r/g, ""); // Remove Line Break from string
            option_C = option_C.replace(/ {1,}/g," ");
            option_C = option_C.trim();
            rows.push(option_C);

            // var option_D = String($(cols[5]).html());
            var option_D = $(cols[5]);
            option_D.find("span").each(function(index) {
                var text = $(this).html();//get span content
                $(this).replaceWith(text);//replace all span with just content
            });
            option_D.find("font").each(function(index) {
                var text = $(this).html();//get span content
                $(this).replaceWith(text);//replace all span with just content
            });
            option_D = String(option_D.html());//get back new string

            option_D = option_D.replace(/\n|\r/g, ""); // Remove Line Break from string
            option_D = option_D.replace(/ {1,}/g," ");
            option_D = option_D.trim();
            rows.push(option_D);

            rows.push($(cols[6]).html())

            data.push(rows)
        });

        data.shift();
        data.unshift(['question','option_A','option_B','option_C','option_D','correct'])
        console.log(data);

        let mapped = data.map(e => e.map(d => `\"${d}\"`).join(`,`))

        // let mapped = data.map(e => `\"${e}\"`.join(`,`))
        let csvContent = `data:text/csv;charset=utf-8,`
            + mapped.join(`\n`);
            var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "Chapter 1 h143-146 1pg.csv");
        document.body.appendChild(link); // Required for FF

        link.click();

    }
</script>


{{--Page specific scripts--}}
{{-- <script>
var table = $("#export_excel_table");
var chapter_id = new Array();
var question = new Array();
var option_A = new Array();
var option_B = new Array();
var option_C = new Array();
var option_D = new Array();
var correct = new Array();
table.find('tr').each(function (i, el) {
    var $tds = $(this).find('td');
        chapter_id.push($tds.eq(0).html());
        question.push($tds.eq(1).html());
        option_A.push($tds.eq(2).text());
        option_B.push($tds.eq(3).text());
        option_C.push($tds.eq(4).text());
        option_D.push($tds.eq(5).text());
        correct.push($tds.eq(6).text());
    // do something with productId, product, Quantity
});
console.log(question[10]);
</script>
<script>
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';

    // Create download link element
    downloadLink = document.createElement("a");

    document.body.pushChild(downloadLink);

    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

        // Setting the file name
        downloadLink.download = filename;

        //triggering the function
        downloadLink.click();
    }
}


</script> --}}




</body>
</html>

