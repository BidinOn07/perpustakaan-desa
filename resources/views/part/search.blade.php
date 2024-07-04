<table id="table" class="table table-bordered table-hover">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action ="/pengunjung/tampilan">
                <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">search</button>
        </div>
            </form>
    </div>
    </div>
