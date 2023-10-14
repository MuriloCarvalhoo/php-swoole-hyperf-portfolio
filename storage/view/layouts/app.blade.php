<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
  <title>{{ env('APP_NAME') }}</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
    crossorigin="anonymous">

  <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link href="/css/app.css" rel="stylesheet" />
  <link href="/css/matrix-tema.css" rel="stylesheet" />

  @yield('styles')

  <style>
    .search {
      right: 15px;
      top: 30px;
      position: absolute;
      display: inline-block;
    }

    .input {
      width: 0px;
      height: 34px;
      background-color: #000;
      box-shadow: none;
      color: #fff;
      border: 1px solid transparent;
      outline: none;
      padding-left: 35px;
      font-size: 16px;
      transition: 0.3s ease all;

      &.toggle {
        width: 240px;
        border-color: #fff;
      }
    }

    #serach-icon {
      width: 18px;
      left: 8px;
      top: 50%;
      transform: translateY(-50%);
      position: absolute;
    }
  </style>
</head>

<body class="container-fluid">
  {{-- <nav class="navbar fixed-top bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ env('MIX_BASE_URL') }}"><strong>Home</strong></a>
      <div class="d-flex">
        <div class="search">
          <input class="input" type="text" placeholder="Titles, people, genres" id="search">
          <svg id="serach-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="search-icon ltr-4z3qvp e1svuwfo1" data-name="MagnifyingGlass"
            aria-hidden="true">
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10ZM15.6177 17.0319C14.078 18.2635 12.125 19 10 19C5.02944 19 1 14.9706 1 10C1 5.02944 5.02944 1 10 1C14.9706 1 19 5.02944 19 10C19 12.125 18.2635 14.078 17.0319 15.6177L22.7071 21.2929L21.2929 22.7071L15.6177 17.0319Z"
              fill="currentColor"></path>
          </svg>
        </div>
      </div>
    </div>
  </nav> --}}

  <div id="app">
    @yield('content')
  </div>

  <script src="/js/app.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
  </script>
  @yield('scripts')

  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script>
    const url = '{{ env('APP_URL') }}';

    $('#serach-icon').click(function() {
      $('.input').toggleClass('toggle')
    });

    $(document).click(function(e) {
      if (!$(e.target).parent(".search").length) {
        $(".search").find(".input").removeClass("toggle");
      }
    });

    // $(document).ready(function() {

    //   $("#search").keyup(function() {
    //     const search = $(this).val();

    //     if (search == '') {
    //       return;
    //     }

    //     console.log(search);

    //     $.ajax({
    //       url: `${url}/movies/get-elastic?search=${search}`,
    //       type: 'GET',
    //       dataType: 'json',
    //       success: function(data) {
    //         console.log(data);

    //         if (data.length > 0) {}
    //       },
    //       error: function(data) {}
    //     });

    //   });
    // });
  </script>
</body>
</html>
