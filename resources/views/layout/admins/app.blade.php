<!DOCTYPE html>
<html lang="en">
<head>
    {{-- include meta tags --}}
   @include('components.utilities',[
    'meta_tags' => true
   ])
{{-- include favicon --}}
@include('components.utilities',[
    'favicon' => true
])
{{-- include vite css --}}
@include('components.utilities',[
    'vite_css' => true
])
{{-- include admin changed vars --}}
@include('components.sections.admins',[
    'css_var' => true
])
{{-- yield css --}}
     @yield('css')

    <title>{{ config('app.name') }} || Admins || @yield('title') </title>

    <style>
        /* body */
        body:has(nav.active){
            overflow:hidden;
        }
        /* header */
        header{
            position: fixed;
            top:0;
            left:0;
            right:0;
            padding:20px;
            display:flex;
            flex-direction:row;
            align-items:center;
            justify-content:space-between;
            gap:10px;
            background:var(--bg-light);
            border-bottom:1px solid var(--rgb-01);
            user-select:none;
            z-index:2000;

        }
        main{
            overflow:auto;
            scrollbar-width: none;
            -webkit-scrollbar-width:none;
           

        }
        /* menu icon */
        .menu-icon{
            width:40px;
            aspect-ratio:1;
          
            color:var(--primary);
            border-radius:10px;
            display:flex;
            flex-direction: column;
            align-items:center;
            justify-content:center;


        }
        /* nav */
        nav{
            position:fixed;
            top:0;
            left:0;
            right:0;
            bottom:0;
            background:rgba(0,0,0,0.1);
            z-index:3000;
            backdrop-filter:blur(20px);
            -webkit-backdrop-filter:blur(10px);
            user-select:none;
            display:none;

        }
        nav .child{
            width:60%;
            background:var(--bg-light);
            height:100%;
            border-right: 1px solid var(--rgb-01);
            display:flex;
            transform:translateX(-100%);
            transition:all 0.5s linear;
            gap:30px;
            flex-direction:column;
            overflow:auto;

        }
        .nav-child-header{
            position:sticky;
            top:0;
            left:0;
            right:0;
            background:inherit;
        }
        nav.active{
            display:flex;
        }
        nav.active .child{
            animation:animate-trans 0.5s linear forwards;

        }
        @keyframes animate-trans{
            0%{
                transform:translateX(-100%);
            }
            100%{
                transform:translateX(0)
            }
        }
        .expandible-nav{
            width:100%;
            display:flex;
            flex-direction:column;
            gap:10px;
            
        }
        .expandible-body{
            width:calc(100% - 30px);
            display:none;
            flex-direction:column;
            gap:5px;
            margin-left:30px;
            background:var(--rgb-005);
            border:1px solid var(--rgb-01);
            border-radius:10px;
            padding:10px;

        }
        .expandible-header:hover{
            background:var(--rgb-005);

        }
        .expandible-header{
            padding:5px;
            border-radius:5px;
        }
        .expandible-body a{
            text-decoration:none;
            color:var(--primary);
            padding:5px;
        }
        .expandible-body a:hover{
            background:var(--bg-light);
            border-radius:5px;
        }
        .nav-a{
            padding:5px;
            border-radius:5px;
        }
        .nav-a:hover{
            background:var(--rgb-005);
        }
        .expandible-nav.active .expandible-body{
            display:flex;
        }
        .expandible-header .chevron svg{
            transition:all 0.2s linear;
        }
        .expandible-nav.active .expandible-header .chevron svg{
            transform:rotate(90deg);
        }
        /* footer */
        footer{
            background:var(--primary);
            padding:20px;
            color:var(--primary-text);
            display:flex;
            flex-direction:column;
            gap:5px;
            text-align:center;
            user-select:none;
            position:none;

        }
        /* search */
        .search{
            position:relative;
        }
        .search .child{
            position:absolute;
            left:0;
            right:0;
            top:100%;
            padding:20px;
            border:1px solid var(--rgb-01);
            background:inherit;
            border-radius:10px;
            display:none;
            flex-direction:column;
            gap:5px;
            z-index:500;
            overflow:hidden;
        }
        .search .child a{
            width:100%;
            display:flex;
            flex-direction: row;
            align-items:center;
            color:var(--rgb-07);
            text-decoration:none;
           cursor:pointer;
           overflow:hidden;
           border-radius:10px;
           clip-path:inset(0 round 10px);
           user-select: none;
          
           
        }
        .search.active .child{
            display:flex;
        }

        
       

        /* media queries */
        @media(min-width:800px){
            /* header */
            header{
                padding-left:calc(30% + 20px);
            }
            .menu-icon{
                display:none;
            }
            /* nav */
            nav{
                display:flex;
                width:30%;
            }
            nav .child{
                transform:none;
                width:100%;

            }
            main{
                width:calc(100% - 30%);
               margin-left:30%;
               
             
               
            }
            .nav-close{
                display:none;
            }
            /* footer */
            footer{
                text-align:start;
                align-items:start;
                width:calc(100% - 30%);
                margin-left:30%;

            }

        
        }
        
    </style>
</head>
<body>
    {{-- include action loader for post requests,get requests and spa loading --}}
    @include('components.utilities',[
        'action_loader' => true
    ])
    {{-- header --}}
    <header>
        {{-- logo --}}
        <div class="row align-center g-10">
            <div class="h-40 br-10 w-40 no-shrink column align-center justify-center p-10 bg-primary primary-text">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="20" width="20"><path d="M213.85,125.46l-112,120a8,8,0,0,1-13.69-7l14.66-73.33L45.19,143.49a8,8,0,0,1-3-13l112-120a8,8,0,0,1,13.69,7L153.18,90.9l57.63,21.61a8,8,0,0,1,3,12.95Z"></path></svg>

            </div>
            <strong style="font-size:30px" class="c-primary">Lumina</strong>
        </div>
        {{-- notifictions --}}
        <div onclick="window.location.href='{{ url('admins/notifications') }}'" style="background:var(--rgb-01)" class="m-left-auto pc-pointer no-select g-5 align-center jusify-center p-5 row w-fit br-1000">
            <span class="h-fit row">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="20" width="20"><path d="M221.8,175.94C216.25,166.38,208,139.33,208,104a80,80,0,1,0-160,0c0,35.34-8.26,62.38-13.81,71.94A16,16,0,0,0,48,200H88.81a40,40,0,0,0,78.38,0H208a16,16,0,0,0,13.8-24.06ZM128,216a24,24,0,0,1-22.62-16h45.24A24,24,0,0,1,128,216Z"></path></svg>

            </span>
            @if (TotalNotifications() > 0)
                  <small class="bg-red bold c-white h-full p-5 p-x-10 br-1000 row">{{ TotalNotifications() }}</small>
    
            @endif
              </div>
        {{-- menu icon --}}
        <div onclick="if(document.querySelector('nav').classList.contains('active')){
        document.querySelector('nav').classList.remove('active')
        }else{
        document.querySelector('nav').classList.add('active')
        }" class="menu-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="30" width="30"><path d="M228,128a12,12,0,0,1-12,12H40a12,12,0,0,1,0-24H216A12,12,0,0,1,228,128ZM40,76H216a12,12,0,0,0,0-24H40a12,12,0,0,0,0,24ZM216,180H40a12,12,0,0,0,0,24H216a12,12,0,0,0,0-24Z"></path></svg>

        </div>
    </header>
    {{-- nav --}}
    <nav onclick="this.classList.remove('active')">
        <div onclick="event.stopPropagation()" class="child">
            {{-- nav child header --}}
            <div class="row nav-child-header p-20 align-center w-full space-between">
                 {{-- logo --}}
        <div class="row align-center g-10">
            <div class="h-40 br-10 w-40 no-shrink column align-center justify-center p-10 bg-primary primary-text">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="20" width="20"><path d="M213.85,125.46l-112,120a8,8,0,0,1-13.69-7l14.66-73.33L45.19,143.49a8,8,0,0,1-3-13l112-120a8,8,0,0,1,13.69,7L153.18,90.9l57.63,21.61a8,8,0,0,1,3,12.95Z"></path></svg>

            </div>
            <strong style="font-size:30px" class="c-primary">Lumina</strong>
        </div>
        {{-- close --}}
        <span onclick="document.querySelector('nav').classList.remove('active')" class="nav-close" style="font-size:40px;">&times;</span>
            </div>
            {{-- nav child body --}}
            <div class="w-full flex-auto column c-primary p-20 g-10">
                {{-- new nav a --}}
                <a href="{{ url('admins/dashboard') }}" class="row nav-a no-u space-between c-primary align-center g-10">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="20" width="20"><path d="M100,116.43a8,8,0,0,0,4-6.93v-72A8,8,0,0,0,93.34,30,104.06,104.06,0,0,0,25.73,147a8,8,0,0,0,4.52,5.81,7.86,7.86,0,0,0,3.35.74,8,8,0,0,0,4-1.07ZM88,49.62v55.26L40.12,132.51C40,131,40,129.48,40,128A88.12,88.12,0,0,1,88,49.62ZM232,128A104,104,0,0,1,38.32,180.7a8,8,0,0,1,2.87-11L120,123.83V32a8,8,0,0,1,8-8,104.05,104.05,0,0,1,89.74,51.48c.11.16.21.32.31.49s.2.37.29.55A103.34,103.34,0,0,1,232,128Z"></path></svg>
                    </span>
                    <span class="font-1 m-right-auto">Dashboard</span>
                    <span>
                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="15" width="15"><path d="M184.49,136.49l-80,80a12,12,0,0,1-17-17L159,128,87.51,56.49a12,12,0,1,1,17-17l80,80A12,12,0,0,1,184.49,136.49Z"></path></svg>

                    </span>
                </a>
                {{-- new nav expandible --}}
                <div onclick="if(this.classList.contains('active')){
                this.classList.remove('active');
                }else{
                this.classList.add('active');
                }" class="expandible-nav">
                    {{-- expandible header --}}
                    <div class="row expandible-header align-center g-10">
                        <span>
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="20" width="20"><path d="M164.38,181.1a52,52,0,1,0-72.76,0,75.89,75.89,0,0,0-30,28.89,12,12,0,0,0,20.78,12,53,53,0,0,1,91.22,0,12,12,0,1,0,20.78-12A75.89,75.89,0,0,0,164.38,181.1ZM100,144a28,28,0,1,1,28,28A28,28,0,0,1,100,144Zm147.21,9.59a12,12,0,0,1-16.81-2.39c-8.33-11.09-19.85-19.59-29.33-21.64a12,12,0,0,1-1.82-22.91,20,20,0,1,0-24.78-28.3,12,12,0,1,1-21-11.6,44,44,0,1,1,73.28,48.35,92.18,92.18,0,0,1,22.85,21.69A12,12,0,0,1,247.21,153.59Zm-192.28-24c-9.48,2.05-21,10.55-29.33,21.65A12,12,0,0,1,6.41,136.79,92.37,92.37,0,0,1,29.26,115.1a44,44,0,1,1,73.28-48.35,12,12,0,1,1-21,11.6,20,20,0,1,0-24.78,28.3,12,12,0,0,1-1.82,22.91Z"></path></svg>



                        </span>
                        <span class="m-right-auto font-1">Users</span>
                        <span class="chevron">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="15" width="15"><path d="M184.49,136.49l-80,80a12,12,0,0,1-17-17L159,128,87.51,56.49a12,12,0,1,1,17-17l80,80A12,12,0,0,1,184.49,136.49Z"></path></svg>
                        </span>
                    </div>
                    {{-- expandible body --}}
                    <div class="expandible-body">
                        <a href="{{ url('admins/users') }}">All Users</a>
                        <a href="{{ url('admins/users?status=active') }}">Active Users</a>
                        <a href="{{ url('admins/users?status=banned') }}">Banned Users</a>
                        <a href="{{ url('admins/users?type=promoter') }}">Promoters/Influencers</a>
                    </div>
                </div>
                 {{-- new nav a --}}
                <a href="{{ url('admins/transactions') }}" class="row nav-a no-u space-between c-primary align-center g-10">
                    <span>
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="20" width="20"><path d="M68,100A12,12,0,0,1,80,88h96a12,12,0,0,1,0,24H80A12,12,0,0,1,68,100Zm12,52h96a12,12,0,0,0,0-24H80a12,12,0,0,0,0,24ZM236,56V208a12,12,0,0,1-17.37,10.73L192,205.42l-26.63,13.31a12,12,0,0,1-10.74,0L128,205.42l-26.63,13.31a12,12,0,0,1-10.74,0L64,205.42,37.37,218.73A12,12,0,0,1,20,208V56A20,20,0,0,1,40,36H216A20,20,0,0,1,236,56Zm-24,4H44V188.58l14.63-7.31a12,12,0,0,1,10.74,0L96,194.58l26.63-13.31a12,12,0,0,1,10.74,0L160,194.58l26.63-13.31a12,12,0,0,1,10.74,0L212,188.58Z"></path></svg>
                   </span>
                    <span class="font-1 m-right-auto">Transactions</span>
                    <span>
                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="15" width="15"><path d="M184.49,136.49l-80,80a12,12,0,0,1-17-17L159,128,87.51,56.49a12,12,0,1,1,17-17l80,80A12,12,0,0,1,184.49,136.49Z"></path></svg>
                       
                    </span>
                </a>
                  {{-- new nav expandible --}}
                <div onclick="if(this.classList.contains('active')){
                this.classList.remove('active');
                }else{
                this.classList.add('active');
                }" class="expandible-nav">
                    {{-- expandible header --}}
                    <div class="row expandible-header align-center g-10">
                        <span>
                         <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="20" width="20"><path d="M228,144v64a12,12,0,0,1-12,12H40a12,12,0,0,1-12-12V144a12,12,0,0,1,24,0v52H204V144a12,12,0,0,1,24,0ZM96.49,80.49,116,61v83a12,12,0,0,0,24,0V61l19.51,19.52a12,12,0,1,0,17-17l-40-40a12,12,0,0,0-17,0l-40,40a12,12,0,1,0,17,17Z"></path></svg>



                        </span>
                        <span class="m-right-auto font-1">Withdrawals</span>
                        <span class="chevron">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="15" width="15"><path d="M184.49,136.49l-80,80a12,12,0,0,1-17-17L159,128,87.51,56.49a12,12,0,1,1,17-17l80,80A12,12,0,0,1,184.49,136.49Z"></path></svg>
                        </span>
                    </div>
                    {{-- expandible body --}}
                    <div class="expandible-body">
                        <a href="{{ url('admins/transactions?type=withdrawal') }}">All Withdrawals</a>
                        <a href="{{ url('admins/transactions?type=withdrawal&status=pending') }}">Pending Withdrawals</a>
                        <a href="{{ url('admins/transactions?type=withdrawal&status=success') }}">Successfull Withdrawals</a>
                        <a href="{{ url('admins/transactions?type=withdrawal&status=rejected') }}">Rejected Withdrawals</a>
                    </div>
                </div>
                  {{-- new nav expandible --}}
                <div onclick="if(this.classList.contains('active')){
                this.classList.remove('active');
                }else{
                this.classList.add('active');
                }" class="expandible-nav">
                    {{-- expandible header --}}
                    <div class="row expandible-header align-center g-10">
                        <span>
                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="20" width="20"><path d="M228,144v64a12,12,0,0,1-12,12H40a12,12,0,0,1-12-12V144a12,12,0,0,1,24,0v52H204V144a12,12,0,0,1,24,0Zm-108.49,8.49a12,12,0,0,0,17,0l40-40a12,12,0,0,0-17-17L140,115V32a12,12,0,0,0-24,0v83L96.49,95.51a12,12,0,0,0-17,17Z"></path></svg>

                        </span>
                        <span class="m-right-auto font-1">Deposits</span>
                        <span class="chevron">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="15" width="15"><path d="M184.49,136.49l-80,80a12,12,0,0,1-17-17L159,128,87.51,56.49a12,12,0,1,1,17-17l80,80A12,12,0,0,1,184.49,136.49Z"></path></svg>
                        </span>
                    </div>
                    {{-- expandible body --}}
                    <div class="expandible-body">
                        <a href="{{ url('admins/transactions?type=deposit') }}">All Deposits</a>
                        <a href="{{ url('admins/transactions?type=deposit&status=pending') }}">Pending Deposits</a>
                        <a href="{{ url('admins/transactions?type=deposit&status=success') }}">Successfull Deposits</a>
                        <a href="{{ url('admins/transactions?type=deposit&status=rejected') }}">Rejected Deposits</a>
                    </div>
                </div>
                 {{-- new nav a --}}
                <a href="{{ url('admins/settings') }}" class="row nav-a no-u space-between c-primary align-center g-10">
                    <span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="20" width="20"><path d="M216,130.16q.06-2.16,0-4.32l14.92-18.64a8,8,0,0,0,1.48-7.06,107.6,107.6,0,0,0-10.88-26.25,8,8,0,0,0-6-3.93l-23.72-2.64q-1.48-1.56-3-3L186,40.54a8,8,0,0,0-3.94-6,107.29,107.29,0,0,0-26.25-10.86,8,8,0,0,0-7.06,1.48L130.16,40Q128,40,125.84,40L107.2,25.11a8,8,0,0,0-7.06-1.48A107.6,107.6,0,0,0,73.89,34.51a8,8,0,0,0-3.93,6L67.32,64.27q-1.56,1.49-3,3L40.54,70a8,8,0,0,0-6,3.94,107.71,107.71,0,0,0-10.87,26.25,8,8,0,0,0,1.49,7.06L40,125.84Q40,128,40,130.16L25.11,148.8a8,8,0,0,0-1.48,7.06,107.6,107.6,0,0,0,10.88,26.25,8,8,0,0,0,6,3.93l23.72,2.64q1.49,1.56,3,3L70,215.46a8,8,0,0,0,3.94,6,107.71,107.71,0,0,0,26.25,10.87,8,8,0,0,0,7.06-1.49L125.84,216q2.16.06,4.32,0l18.64,14.92a8,8,0,0,0,7.06,1.48,107.21,107.21,0,0,0,26.25-10.88,8,8,0,0,0,3.93-6l2.64-23.72q1.56-1.48,3-3L215.46,186a8,8,0,0,0,6-3.94,107.71,107.71,0,0,0,10.87-26.25,8,8,0,0,0-1.49-7.06ZM128,168a40,40,0,1,1,40-40A40,40,0,0,1,128,168Z"></path></svg>
               </span>
                    <span class="font-1 m-right-auto">Site Settings</span>
                    <span>
                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="15" width="15"><path d="M184.49,136.49l-80,80a12,12,0,0,1-17-17L159,128,87.51,56.49a12,12,0,1,1,17-17l80,80A12,12,0,0,1,184.49,136.49Z"></path></svg>
                       
                    </span>
                </a>





                <div onclick="window.location.href='{{ url('admins/logout') }}'" style="border:1px solid red;color:red;background:rgba(255,0,0,0.1)" class="w-full pointer m-top-auto justify-center br-10 p-10 g-5 align-center row">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="20" width="20"><path d="M120,216a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H56V208h56A8,8,0,0,1,120,216Zm109.66-93.66-40-40A8,8,0,0,0,176,88v32H112a8,8,0,0,0,0,16h64v32a8,8,0,0,0,13.66,5.66l40-40A8,8,0,0,0,229.66,122.34Z"></path></svg>
                    </span>
                    <span>Sign Out</span>
                </div>





            </div>
        </div>
    </nav>
    {{-- main --}}
    <main>
        {{-- yield main --}}
        @yield('main')
    </main>
    <footer>
        <span>{{ config('app.name') }} Admin Dashboard <br> &copy;{{ date('Y') }} powered by Lumina Admin</span>
        <span>Coding and design by <a style="color:aqua" href="https://wa.me/+2349013350351">Techie Innovations</a></span>

    </footer>
  @include('components.utilities',[
    'vite_js' => true
  ])
  <script>
    function spa(event,url){
        window.location.href=url;
    }
   async function Search(element,url){
    
    if(element.value.trim() == ''){
        element.closest('.search').classList.remove('active');
        return;
    }
        let response=await fetch(url);
        if(response.ok){
            let data=await response.text();
            element.closest('.search').classList.add('active');
            element.closest('.search').querySelector('.child').innerHTML=data;
        }else{
             element.closest('.search').classList.add('active');
             element.closest('.search').querySelector('.child').innerHTML=` <a href="/" class="w-full row align-center g-10">
                    <span>
                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="CurrentColor" height="20" width="20"><path d="M128,20A108,108,0,1,0,236,128,108.12,108.12,0,0,0,128,20Zm0,192a84,84,0,1,1,84-84A84.09,84.09,0,0,1,128,212ZM76,108a16,16,0,1,1,16,16A16,16,0,0,1,76,108Zm104,0a16,16,0,1,1-16-16A16,16,0,0,1,180,108Zm-3.26,57a12,12,0,0,1-19.48,14,36,36,0,0,0-58.52,0,12,12,0,0,1-19.48-14,60,60,0,0,1,97.48,0Z"></path></svg>
                 </span>
                  <span>${response.status} Error</span>
                
                </a>`;
        }
    }
    document.querySelector('main').style.height=Math.abs(document.querySelector('body').getBoundingClientRect().height - document.querySelector('header').getBoundingClientRect().height) + 'px';
    document.querySelector('main').style.marginTop=document.querySelector('header').getBoundingClientRect().height + 'px';
  </script>
  {{-- yield js --}}
    @yield('js')
</body>
</html>