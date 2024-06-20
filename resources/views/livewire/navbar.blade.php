<div class="antialiased">
    <div class="w-full text-gray-700 bg-primary shadow-md">
        <div x-data="{ open: true }"
             class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
            <div class="flex flex-row items-center justify-between p-4">
                <a href="{{route('home')}}"
                   class="text-lg font-semibold tracking-widest text-gray-900 hover:text-white uppercase rounded-lg focus:outline-none focus:shadow-outline">StepByStep</a>
            </div>
            <nav :class="{'flex': open, 'hidden': !open}"
                 class="flex-col flex-grow hidden pb-4 md:pb-0 md:flex md:justify-end md:flex-row">
                <a class="px-4 py-2 mt-2 text-sm text-slate-900 font-semibold rounded-lg  md:mt-0 md:ml-4 hover:bg-secondary hover:text-white focus:outline-none focus:shadow-outline"
                   href="{{route('home')}}">Dashboard</a>
                <a class="px-4 py-2 mt-2 text-sm text-slate-900 font-semibold rounded-lg  md:mt-0 md:ml-4 hover:bg-secondary hover:text-white focus:outline-none focus:shadow-outline"
                   href="{{route('categories')}}">Categorias</a>
                <a class="px-4 py-2 mt-2 text-sm text-slate-900 font-semibold rounded-lg  md:mt-0 md:ml-4 hover:bg-secondary hover:text-white focus:outline-none focus:shadow-outline"
                   href="{{route('tasks')}}">Tarefas</a>
                <label for="" class="pl-2 text-tertiary">Planeje seus objetivos - Otimize seu tempo - Continue
                    evoluindo</label>
            </nav>
        </div>
    </div>
</div>

