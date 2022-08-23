<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{csrf_token()}}" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/create.css')}}">
    <title>Document</title>
</head>
<body>
    <div class="container p-4">
                
        <form action="{{route('articles.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="card">
                <div class="card-body">
                    <h5 class="card-header">Votre annonce</h5>
                    <div class="card mb-3">
                        <label for="category">Catégories</label>
                        <select class="custom-select" name="category" id="category">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div class="card mb-3">
                        <label for="title">Titre</label>
                        <input type="text" name="title" id="title">
                    </div>
                    
                    <div class="card mb-3">
                        <label for="texte">Texte</label>
                        <textarea class="form-control" id="texte" name="content" rows="3" required></textarea>
                    </div>

                    <div class="card mb-3">
                        <label for="images">Téléchargez vos images</label>
                        <input type="file" name="images[]" multiple id="images">
                    </div>
                </div>

                <h5 class="card-header">Votre localisation</h5>
                <div class="card-body">
                    <div class="card mb-3">
                        <label for="region">Région</label>
                        <select class="custom-select" name="region" id="region">
                            @foreach ($regions as $region)
                            <option value="{{$region->id}}">{{$region->name}}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="card mb-3">
                        <label for="department">Département</label>
                        <select class="custom-select" name="department" id="department">
                            @foreach ($departments as $department)
                            <option value="{{$department->id}}"">{{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="card mb-3">
                        <label for="municipality">Commune</label>
                        <select class="custom-select" name="municipality" id="municipality">
                            @foreach ($municipalities as $municipality)
                            <option value="{{$municipality->id}}"">{{$municipality->name}}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="card mb-3">
                        <label for="district">Quartier</label>
                        <select class="custom-select" name="district" id="district">
                            @foreach ($districts as $district)
                            <option value="{{$district->id}}"">{{$district->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <h5 class="card-header">Votre identité</h5>
                <div class="card-body"> 
                    <div class="card mb-3">
                        <label for="fname">Nom et Prénom</label>
                        <input type="text" name="fname" id="fname">
                    </div>

                    <div class="card mb-3">
                        <label for="occupation">Profession</label>
                        <input type="text" name="occupation" id="occupation">
                    </div>

                    <div class="card mb-3">
                        <label for="contac">Contact</label>
                        <input type="text" name="contact" id="contact">
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Valider</button>   
        
        </form>
    
    </div>



    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    
</body>
</html>