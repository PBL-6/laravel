<div>
    <link rel="stylesheet" href="{{asset('style/login.css')}}">
    <div class="container mt-5">
        <form class="mx-auto" wire:submit="login">
            <a href="#" class="d-flex justify-content-center mb-3">
{{--                <img src="{{asset('img/logopnj.png')}}" width="100" alt="">--}}
            </a>
            <h4 class="text-center">Welcome, admin</h4>
            <h6 class="text-desc">Enter your email and password to login</h6>
            <div class="mb-3 mt-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" wire:model.blur="email">
                @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" wire:model.blur="password">
                @error('password')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn w-100 rounded-3" style="background-color: #008797; color: white;">Login</button>
        </form>
    </div>
{{--        <div class="row">--}}
{{--            <div class="col-3">--}}
{{--            </div>--}}
{{--            <div class="col-6">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body rounded-3">--}}
{{--                        <div class="text-center">--}}
{{--                            <h3 class="fw-bold">Welcome, Admin</h3>--}}
{{--                            Enter your email and password to login--}}
{{--                        </div>--}}
{{--                        <div class="ms-4 me-4">--}}
{{--                            <form wire:submit="login">--}}
{{--                                <div class="mt-3">--}}
{{--                                    <label for="email" class="form-label">Email</label>--}}
{{--                                    <input type="email" class="form-control rounded-3 @error('email') is-invalid @enderror" id="email" placeholder="Email" wire:model.blur="email">--}}
{{--                                    @error('email')--}}
{{--                                    <div class="invalid-feedback">--}}
{{--                                        {{$message}}--}}
{{--                                    </div>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                                <div class="mt-3">--}}
{{--                                    <label for="password" class="form-label">Password</label>--}}
{{--                                    <input type="password" class="form-control rounded-3 @error('password') is-invalid @enderror" id="password" placeholder="Password" wire:model.blur="password">--}}
{{--                                    @error('password')--}}
{{--                                        <div class="invalid-feedback">--}}
{{--                                            {{$message}}--}}
{{--                                        </div>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                                <div class="mt-3 text-center">--}}
{{--                                    <button type="submit" style="background-color: #008797; color: white;" class="btn rounded-3 w-100">Login</button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-3">--}}
{{--            </div>--}}
{{--        </div>--}}
</div>
