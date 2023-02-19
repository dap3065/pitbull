<div class="container">
    <img class="logo img-fluid" src="{{ asset('img/logo.png') }}" alt="Paperwork Rite Kennels">
    <h2>Hello {{ $name }}</h2> <br><br>
    <p>
        You have got an email from : {{ $appName }}<br/>
        Subject: {{ $subject }}
    </p>
    <p>
        {{ $body }}
    </p>
    <p>
        Thank you!
    </p>
</div>
