<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Articles</h1>
    <form class="d-flex mb-3 w-50" role="search" action="{{route('articles.search')}}" method="GET">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="q" value="{{request()->q ?? ''}}">
      <button class="btn btn-outline-success" type="submit" >
        <i class="bi bi-search"></i>
      </button>
  </form>
    <div class="btn-toolbar mb-2 mb-md-0">
      
      <div class="btn-group me-2">
        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
      </div>
      <a href="{{route("articles.create")}}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-plus-circle"></i>
          New Article
      </a>

    </div>
  </div>