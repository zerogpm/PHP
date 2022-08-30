<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>My Contact</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="/css/custom.css" rel="stylesheet">
    <link href="/css/jasny-bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand text-uppercase" href="#">
                My contact
            </a>
        </div>
        <!-- /.navbar-header -->
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <div class="nav navbar-right navbar-btn">
                <a href="{{ route("contacts.create") }}" class="btn btn-default">
                    <i class="glyphicon glyphicon-plus"></i>
                    Add Contact
                </a>
            </div>
            <form action="{{ route("contacts.index") }}" class="navbar-form navbar-right" role="search">
                <div class="input-group">
                    <input type="text" name="term" value="{{ Request::get("term") }}" class="form-control" placeholder="Search..."/>
                    <span class="input-group-btn">
                        <button class="btn btn-default">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</nav>

<!-- content -->
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <?php $selected_group = Request::get('group_id') ?>
                <a href="{{ route('contacts.index') }}" class="list-group-item {{ empty($selected_group) ? 'active' : '' }}">All Contact <span class="badge">{{ App\Contact::count() }}</span></a>
                @foreach (App\Group::all() as $group)
                    <a href="{{ route('contacts.index', ['group_id' => $group->id]) }}" class="list-group-item {{ $selected_group == $group->id ? 'active' : '' }}">{{ $group->name }} <span class="badge">{{ $group->contacts->count() }}</span></a>
                @endforeach
            </div>
        </div><!-- /.col-md-3 -->

        <div class="col-md-9">

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="/js/jasny-bootstrap.min.js"></script>
</body>
</html>