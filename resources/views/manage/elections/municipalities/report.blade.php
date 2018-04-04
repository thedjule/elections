@extends('layouts.manage')

@section('content')

    <p style="text-align: right;">Obrazac PG - 22</p>
    <p style="text-align: right;">(član 92 Zakona)</p>
    <p></p>
    <p style="text-align: center;"><strong>Z A P I S N I K</strong></p>
    <p style="text-align: center;">O RADU OPŠTINSKE IZBORNE KOMISIJE ZA UTVRDJIVANJE<br />REZULTATA GLASANJA ZA POSLANIKE NA BIRAČKIM MJESTIMA U</p>
    <p style="text-align: center;">OPŠTINI {{ $municipality->name }}</p>

    <p>Radjen dana_________ godine, u ____ časova.</p>
    <p>Prisutni članovi Komisije:</p>
    <p>_______________________________</p>
    <p>_______________________________</p>
    <p>&nbsp; &nbsp; &nbsp;(navesti sve članove komisije)</p>
    <p>Komisija je primila zapisnik i drugi izborni materijal od svih biračkih odbora <br />sa područja {{ $municipality->name }}.</p>

    <p>Na osnovu primljenog izbornog materijala, utvrdjeno je:</p>
    <p>- da je u birački spisak ukupno upisano {{ $registered }} birača;</p>
    <p>- da je na biračkim mjestima glasalo {{ $votedAtThePollingStation }} birača;</p>
    <p>- da je van biračkih mjesta, odnosno putem pisma glasalo {{ $votedOutOfThePollingStation }} birača;</p>
    <p>- da je ukupno glasalo {{ $inTotal }} birača.</p>
    <p>- da je ukupno bilo {{ $received }} primljenih glasačkih listića;</p>
    <p>- da je bilo {{ $unused }} neupotrijebljenih glasačkih listića;</p>
    <p>- da je bilo {{ $controlCoupons }} kontrolnih kupona i potvrda-odrezaka {{ $trimConfirmations }};</p>
    <p>- da je bilo {{ $used }} upotrijebljenih glasačkih listića;</p>
    <p>- da je bilo {{ $invalid }} nevažećih glasačkih listića;</p>
    <p>- da je bilo {{ $valid }} važećih glasačkih listića.</p>
    <p>Na osnovu rezultata glasanja na svakom biračkom mjestu, opštinska izborna komisija utvrdjuje da je pojedina
        izborna lista za izbor poslanika u opštini {{ $municipality->name }} dobila sljedeći broj glasova, i to:</p>
    <p></p>

    <ol type="I">
        @foreach($electoralLists as $electoralList)
            <li>{{ $electoralList->name }} {{ $electoralListsSum[$loop->index] }} glasova.</li>
        @endforeach
    </ol>

    <p></p>
    <p style="text-align: center;">- 2 -</p>
    <p>Članovi opštinske izborne komisije imali su/nijesu imali prigovora na utvrđivanje rezultata izbora.</p>
    <p>Primjedbe na zapisnik dao je _____________________________</p>
    <p style="padding-left: 180px;">(ime i prezime i svojstvo)</p>
    <p>Zapisnik je sačinjen dana _ ____ godine u časova.</p>
    <p>Broj _________________</p>
    <p>U ___________________</p>
    <p style="padding-left: 30px;">(mjesto i datum)</p>
    <p></p>
    <p style="text-align: center;">OPŠTINSKA IZBORNA KOMISIJA</p>
    <p>SEKRETAR KOMISIJE &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; PREDSJEDNIK KOMISIJE</p>
    <p>______________________ M.P. __________________________</p>
    <p style="padding-left: 60px;">&nbsp; &nbsp; (ime i prezime) &nbsp; &nbsp; (ime i prezime)</p>
    <p>_______________________ __________________________</p>
    <p style="padding-left: 60px;">(potpis) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (potpis)</p>
    <p>ČLANOVI KOMISIJE:</p>
    <p>1. ___________________________</p>
    <p style="padding-left: 30px;">&nbsp; &nbsp; &nbsp; &nbsp; (ime i prezime)</p>
    <p>&nbsp; &nbsp; ____________________________</p>
    <p style="padding-left: 60px;">(potpis)</p>
    <p>2. ___________________________</p>
    <p style="padding-left: 30px;">&nbsp; &nbsp; &nbsp; &nbsp; (ime i prezime)</p>
    <p>&nbsp; &nbsp; ____________________________</p>
    <p style="padding-left: 60px;">(potpis)</p>
    <p>3. ___________________________</p>
    <p style="padding-left: 30px;">&nbsp; &nbsp; &nbsp; &nbsp; (ime i prezime)</p>
    <p>&nbsp; &nbsp; ____________________________</p>
    <p style="padding-left: 90px;">(potpis)</p>
    <p>(Navesti imena svih članova Komisije)</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p style="text-align: right;">Obrazac PG - 23</p>
    <p style="text-align: right;">(član 92 stav 4 Zakona)</p>
    <p></p>
    <p>Na osnovu člana člana 92 stav 4 Zakona o izboru odbornika i poslanika ("Službeni list RCG", br.4/98,17/98,14/00,9/01, 41/02, 46/02. i 48/06 i "Službeni list CG", broj 46/11 i 14/14) Opštinska izborna komisija Opštine {{ $municipality->name }} podnosi</p>
    <p></p>
    <p style="text-align: center; font-weight: bold;">I Z V J E Š T A J</p>
    <p style="text-align: center;">O REZULTATIMA GLASANJA ZA POSLANIKE NA</p>
    <p style="text-align: center;">PODRUČJU OPŠTINE {{ $municipality->name }}. </p>
    <p></p>
    <p>Opštinska izborna komisija __________________________ na sjednici održanoj dana __________godine, u _______časova, razmotrila je izvještaje sa svih biračkih mjesta u opštini __________________.</p>
    <p>Na osnovu izbornog materijala sa svih biračkih mjesta u opštini {{ $municipality->name }} utvrdjeno je da je pojedina izborna lista za izbor poslanika dobila sljedeći broj glasova, i to:</p>
    <ol type="I">
        @foreach($electoralLists as $electoralList)
            <li>{{ $electoralList->name }} {{ $electoralListsSum[$loop->index] }} glasova.</li>
        @endforeach
    </ol>
    <p>(Navesti podatke o svim izbornim listama, kao pod I i II po redosljedu utvrdjenom na glasačkom listiću).</p>
    <p>Članovi opštinske izborne komisije imali su/nijesu imali prigovora na utvrđivanje rezultata izbora.</p>
    <p>Primjedbe na izvještaj dao je: _______________________________</p>
    <p style="padding-left: 210px;">(ime i prezime)</p>
    <p> _________________________________</p>
    <p style="padding-left: 90px;">(svojeručno)</p>
    <p>Izvještaj je sačinjen dana____________ godine u _____ časova.</p>
    <p>Broj _______</p>
    <p>u ___________________</p>
    <p>(mjesto i datum)</p>
    <p></p>
    <p style="text-align: center;">OPŠTINSKA IZBORNA KOMISIJA</p>
    <p>SEKRETAR KOMISIJE, PREDSJEDNIK KOMISIJE</p>
    <p></p>
    <p>&nbsp;&nbsp; &nbsp; (ime i prezime) (ime i prezime)</p>
    <p>_____________________ &nbsp; &nbsp; M.P. _________________________</p>
    <p>&nbsp;&nbsp; (svojeručni potpis) &nbsp; &nbsp; &nbsp; (svojeručni potpis)</p>
    <p>________________________</p>
    <p>&nbsp; &nbsp; &nbsp; (članovi komisije)</p>

@endsection