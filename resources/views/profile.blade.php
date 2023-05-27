<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ URL::asset('css/estilos.css') }} " rel="stylesheet">
    <title>Profile</title>
</head>

<body>
    <x-navbar />
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Page title -->
                <div class="my-5">
                    <h3>My Profile</h3>
                    <hr>
                </div>
                <!-- Form START -->
                <form class="file-upload" id="formAccountSettings" method="POST"
                    action="{{ route('profile.update', auth()->id()) }}" enctype="multipart/form-data"
                    class="needs-validation" role="form" novalidate>
                    @csrf
                    <div class="row mb-5 gx-5">
                        <!-- Contact detail -->
                        <div class="col-xxl-8 mb-5 mb-xxl-0">
                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                <div class="row g-3">
                                    <h4 class="mb-4 mt-0">Contact detail</h4>
                                    <!-- First Name -->
                                    <div class="col-md-6">
                                        <label class="form-label">First Name *</label>
                                        <input type="text" class="form-control" placeholder=""
                                            aria-label="First name" value={{ $user->name }} name="name">
                                    </div>
                                    <!-- Nif -->
                                    <div class="col-md-6">
                                        <label class="form-label">NIF (opcional)</label>
                                        <input type="number" class="form-control" placeholder="" aria-label="NIF"
                                            value={{ $user->cliente->nif }} name="nif">
                                    </div>
                                    <!-- Phone number -->
                                    <div class="col-md-6">
                                        <label class="form-label">Email *</label>
                                        <input type="email" class="form-control" placeholder="" aria-label="Email"
                                            value={{ $user->email }} name="email">
                                    </div>
                                </div> <!-- Row END -->
                            </div>
                        </div>
                        <!-- Upload profile -->
                        <div class="col-xxl-4">
                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                <div class="row g-3">
                                    <h4 class="mb-4 mt-0">Upload your profile photo</h4>
                                    <div class="text-center">
                                        <div class="picture-container">
                                            <div class="picture">
                                                <img src="{{ url('storage/fotos/' . $user->foto_url) }}"
                                                    class="picture-src" id="wizardPicturePreview" title="">
                                                <input type="file" class="" name="foto">
                                            </div>
                                            <h6 class="">Choose Picture</h6>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row END -->
                    <div class="gap-3 d-md-flex justify-content-md-end text-center">
                        <button type="submit">Submit</button>
                    </div>
                </form> <!-- Form END -->
            </div>
        </div>
    </div>
</body>

</html>
