@extends('layouts.main') @section('title') Главная @parent @endsection @section('content')
<section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Some about project</h1>
            <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
            <p>
                <a href="{{ route('categories.index') }}" class="btn btn-primary my-2">Категории новостей</a>
            </p>
        </div>
    </div>
</section>
<div class="col">
    <div class="card shadow-sm">
        <div class="card-body">
            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod, expedita quia! Omnis ut praesentium et temporibus officiis nostrum voluptas consectetur? Ut veritatis modi aliquam, vel eaque repellendus aperiam libero deserunt repellat atque. Recusandae accusantium adipisci temporibus quisquam doloribus accusamus! Recusandae earum et voluptas nam, doloribus consectetur iure aspernatur, odit nemo sed soluta ad, magni placeat beatae ipsa qui rem suscipit mollitia. Asperiores consequuntur quia accusamus quaerat mollitia quasi magnam sed facere excepturi. Eligendi praesentium quod hic ipsum rem similique explicabo possimus reprehenderit consectetur illum deleniti dolores magni excepturi asperiores quibusdam modi, aliquam provident. Vel fuga mollitia dolorem accusamus ex animi sint deleniti aliquid, necessitatibus neque at maiores quos laboriosam id voluptas ipsa tempora soluta. Inventore, asperiores. Delectus, magnam nobis quam dolorem quae similique suscipit nemo aliquam earum autem deleniti minus aspernatur expedita reiciendis maxime enim debitis possimus est magni eos? Possimus placeat ea alias quo laborum in error quia quas expedita! Id, amet. Perferendis, tempora ipsa? Iste nostrum minima vitae ratione ad mollitia inventore odio accusamus atque esse, ipsam ducimus eveniet dolore, illo error quis voluptatum fuga architecto. Tempora id reiciendis corporis. Quasi sunt recusandae animi suscipit, accusamus eaque numquam quis, soluta earum quam beatae minus atque consectetur optio. Quas!</p>
        </div>
    </div>
</div>
@endsection