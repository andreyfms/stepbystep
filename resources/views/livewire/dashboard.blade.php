<div class="flex flex-wrap justify-around items-start container mx-auto px-4">
    @if(count($categories) > 0)
        @foreach($categories as $index => $category)
            <div
                class="w-full sm:w-[45%] md:w-[30%] lg:w-[30%] xl:w-[30%] mx-auto my-10 rounded bg-secondary border-2 border-primary rounded-xl shadow-xl">
                <div class="p-8">
                    <h1 class="text-3xl font-medium my-1 text-slate-900 tracking-wider">{{ $category->name }}</h1>

                    <form wire:submit.prevent="addTask({{ $category->id }}, {{ $index }})">
                        <input wire:model.defer="newTaskName.{{ $index }}"
                               placeholder="Olá! Qual é o nosso próximo passo?"
                               class="w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border border-tertiary rounded-lg focus:border-primary focus:bg-white focus:outline-none focus:shadow-outline focus:ring-2 ring-primary">
                    </form>

                    <div id="tasks" class="mt-5">
                        <div id="task" class="bg-white py-3 px-2 max-h-96 overflow-auto rounded"
                             style="scrollbar-width: thin; scrollbar-color: #0F172A #f0f0f0;">
                            @if($category->tasks->count() > 0)
                                @foreach($category->tasks as $task)
                                    <div class="flex justify-between items-center hover:bg-tertiary rounded p-3">
                                        <div class="flex w-[75%] items-start space-x-2">
                                            <div>
                                                <svg wire:click="doneTask({{ $task->id }})"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                     stroke="currentColor"
                                                     class="w-6 h-6 cursor-pointer {{ $task->done ? 'text-green-600 hover:text-red-500' : 'text-slate-500 hover:text-green-600' }}">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="{{ $task->done ? 'M4.5 12.75l6 6 9-13.5' : 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z' }}"/>
                                                </svg>
                                            </div>
                                            @if($editingTask === $task->id)
                                                <div class="text-slate-900">
                                                    <input wire:model="updateNameTask"
                                                           class="w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border border-tertiary rounded-lg focus:border-primary focus:bg-white focus:outline-none focus:shadow-outline focus:ring-2 ring-primary"
                                                           type="text">
                                                </div>
                                            @else
                                                <div class="text-slate-900 {{ $task->done ? 'line-through' : '' }}">
                                                    {{ $task->name }}
                                                </div>
                                            @endif
                                        </div>
                                        @if($viewDescription === $task->id )
                                            <div class="text-slate-900">{{ $task->description }}</div>
                                        @endif
                                        <div class="w-[25%] flex justify-around items-center">
                                            <div wire:click="showDescription({{ $task->id }})">
                                                @if($viewDescription === $task->id)
                                                    <svg class="cursor-pointer w-5 text-slate-900" fill="none"
                                                         viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                                    </svg>
                                                @else
                                                    <svg class="cursor-pointer w-5 text-slate-900" width="24"
                                                         height="24"
                                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                         fill="none"
                                                         stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z"/>
                                                        <circle cx="12" cy="12" r="2"/>
                                                        <path d="M2 12l1.5 2a11 11 0 0 0 17 0l1.5 -2"/>
                                                        <path d="M2 12l1.5 -2a11 11 0 0 1 17 0l1.5 2"/>
                                                    </svg>
                                                @endif
                                            </div>
                                            @if($editingTask === $task->id)
                                                <button wire:click="updateTask({{ $task->id }})">
                                                    <svg class="cursor-pointer w-5" viewBox="0 0 24 24" fill="none"
                                                         stroke="currentColor" stroke-width="2"
                                                         stroke-linecap="round"
                                                         stroke-linejoin="round">
                                                        <path
                                                            d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                                        <polyline points="17 21 17 13 7 13 7 21"/>
                                                        <polyline points="7 3 7 8 15 8"/>
                                                    </svg>
                                                </button>
                                            @else
                                                <button wire:click="editTask({{ $task->id }})">
                                                    <svg class="cursor-pointer w-5 text-slate-900"
                                                         viewBox="0 0 24 24"
                                                         stroke-width="2" stroke="currentColor" fill="none"
                                                         stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z"/>
                                                        <path
                                                            d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"/>
                                                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"/>
                                                        <line x1="16" y1="5" x2="19" y2="8"/>
                                                    </svg>
                                                </button>
                                            @endif
                                            <button wire:click="deleteTask({{ $task->id }})">
                                                <svg class="cursor-pointer h-5 w-5 text-slate-900" width="24"
                                                     height="24"
                                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                     fill="none"
                                                     stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z"/>
                                                    <line x1="4" y1="7" x2="20" y2="7"/>
                                                    <line x1="10" y1="11" x2="10" y2="17"/>
                                                    <line x1="14" y1="11" x2="14" y2="17"/>
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="p-2 text-xs text-gray-600 uppercase">Sem registros de tarefa para essa
                                    categoria.</p>
                            @endif
                        </div>


                        <div class="flex justify-end items-center">
                            <div class="p-3 rounded-lg my-3 text-white
                            @switch($category->priority)
                                @case('high')
                                    bg-red-500
                                    @break
                                @case('medium')
                                    bg-yellow-500
                                    @break
                                @default
                                    bg-blue-500
                            @endswitch
                            focus:outline-none">
                                {{ ucfirst($category->priority) }}
                            </div>
                            {{--                                <div class="flex-initial pl-3">--}}
                            {{--                                    <button wire:click="deleteCategory({{ $category->id }})"--}}
                            {{--                                            class="px-5 py-2.5 border font-medium tracking-wide capitalize text-primary bg-white rounded-md hover:bg-primary hover:text-white shadow-md border-primary transition duration-300 transform active:scale-95 ease-in-out">--}}
                            {{--                                        Finalizar--}}
                            {{--                                    </button>--}}
                            {{--                                </div>--}}
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="w-full mx-auto p-10 pt-32 text-center">
            <div
                class="flex justify-center w-full p-4 rounded-lg bg-primary shadow-xl text-base leading-5 text-white opacity-100">
                <svg class="h-5 w-5 text-slate-900" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                     stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z"/>
                    <path
                        d="M13 3a1 1 0 0 1 1 1v4.535l3.928 -2.267a1 1 0 0 1 1.366 .366l1 1.732a1 1 0 0 1 -.366 1.366L16.001 12l3.927 2.269a1 1 0 0 1 .366 1.366l-1 1.732a1 1 0 0 1 -1.366 .366L14 15.464V20a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-4.536l-3.928 2.268a1 1 0 0 1 -1.366 -.366l-1-1.732a1 1 0 0 1 .366 -1.366L7.999 12 4.072 9.732a1 1 0 0 1 -.366 -1.366l1-1.732a1 1 0 0 1 1.366 -.366L10 8.535V4a1 1 0 0 1 1 -1h2z"/>
                </svg>
                <span class="pl-4">Comece definindo a categoria das suas tarefas!</span>
            </div>
        </div>
    @endif
</div>
