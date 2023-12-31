@if ($data->image)
    <img src="{{ asset($data->image) }}" height="60" style="position: absolute; left: 0px; left: 0px;">
@else
    <img src="{{ asset('public/img/logo_clinic.jpeg') }}" height="60" style="position: absolute; left: 0px; left: 0px;">
@endif
<table width="100%">
    <tr>
        <td align="center">
            <strong style="font-size: 24px;">{{$data->clinic->name}}</strong><br/>
            {{$data->clinic->address}}<br/>
            Telepon {{$data->clinic->phone}}
        </td>
    </tr>
</table>
<hr/>
<p style="margin-bottom: 0px; font-weight: bold; text-decoration: underline; font-size: 16px; text-align: center;">Surat Keterangan</p>
<p style="text-align: center; margin-top: 0px;">No: {{$data->transaction_no}}</p>
<p>Yang bertanda tangan dibawah ini Dokter pemeriksa {{$data->medicalStaff->name}}, menerangkan bahwa :</p>
<table width="100%">
    <tr>
        <td width="20%">Nama</td>
        <td>: @if($data->for_relationship == 0) {{$data->patient->name}} @else {{$data->patientRelationship->name}} @endif</td>
    </tr>
    <tr>
        <td>Umur</td>
        <td>: @if($data->for_relationship == 0) {{getAge($data->patient->birth_date)}} @else {{getAge($data->patientRelationship->birth_date)}} @endif Tahun</td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>: @if($data->for_relationship == 0) {{__($data->patient->gender)}} @else {{__($data->patientRelationship->gender)}} @endif</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>: @if($data->for_relationship == 0) {{$data->patient->address}} @else {{$data->patientRelationship->address}} @endif</td>
    </tr>
</table>
<p>Berdasarkan hasil pemeriksaan yang kami lakukan, ternyata yang bersangkutan mendapatkan tanda-tanda kehamilan <b>({{$data->result}})</b>.</p>
<p>Demikian surat ini dibuat dan diberikan untuk dipergunakan sebagaimana mestinya.</p>
<table width="100%">
    <tr>
        <td width="70%"></td>
        <td width="30%" align="center">
            {{$data->clinic->location}}, {{\Carbon\Carbon::parse($data->transaction_date)->isoFormat("DD MMMM YYYY")}}<br/>
            <br/>
            @if ($data->medicalStaff->image)
            <img src="{{ asset($data->medicalStaff->image) }}" height="60">                
            @endif
            <br/>
            <br/>
            {{$data->medicalStaff->name}}
        </td>
    </tr>
</table>