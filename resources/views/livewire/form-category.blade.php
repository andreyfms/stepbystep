<div>
    <div class="m-auto container px-4 w-full flex flex-wrap justify-around items-start">
        <form wire:submit.prevent="save" class="w-full sm:w-2/5 mt-5 bg-white rounded-lg shadow-xl">
            <div class="flex bg-primary rounded-t-lg">
                <div class="flex-1 py-5 pl-5 overflow-hidden">
                    <h1 class="inline text-2xl text-white font-semibold leading-none">Categorias</h1>
                </div>
            </div>

            <div class="px-5 pb-5">
                <div class="mt-3">
                    <label for="name_category" class="p-3">Título</label>
                    <input wire:model="form.name" id="name_category" placeholder="Título da Categoria"
                           class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border border-tertiary rounded-lg focus:border-primary focus:bg-white focus:outline-none focus:shadow-outline focus:ring-2 ring-primary">
                    @error('form.name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mt-3">
                    <label for="priority_category" class="p-3">Prioridade</label>
                    <select wire:model="form.priority"
                            id="priority_category"
                            class="text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border border-tertiary rounded-lg focus:border-blueGray-500 focus:bg-white focus:outline-none focus:shadow-outline focus:ring-2 ring-primary">
                        <option value="">Selecione a prioridade...</option>
                        <option value="high">Alta</option>
                        <option value="medium">Média</option>
                        <option value="low">Baixa</option>
                    </select>
                    @error('form.priority') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex flex-row-reverse p-3">
                <div class="flex-initial pl-3">
                    <button type="submit"
                            class="flex items-center px-5 py-2.5 border font-medium tracking-wide capitalize text-primary bg-white rounded-md hover:bg-primary hover:text-white hover:border-secondary shadow-md border-primary focus:outline-none focus:bg-gray-900 transition duration-300 transform active:scale-95 ease-in-out">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                            <polyline points="17 21 17 13 7 13 7 21"/>
                            <polyline points="7 3 7 8 15 8"/>
                        </svg>
                        <span class="pl-2 mx-1">{{ $editing ? 'Salvar Categoria' : 'Nova Categoria' }}</span>
                    </button>
                </div>
            </div>
        </form>

        <div class="w-full sm:w-2/5 mt-5">
            <div class="max-h-96 bg-white shadow-xl cursor-pointer rounded-lg overflow-auto" style="scrollbar-width: thin; scrollbar-color: #5E7CE2 #f0f0f0;">
                @foreach($categories as $category)
                    <div class="flex sm:flex-row items-center sm:justify-between hover:bg-primary bg-white">
                        <div class="flex-1 flex text-black hover:text-white justify-between items-center py-5 pl-5 overflow-hidden" wire:click="show({{$category->id}})">
                            <ul>
                                <li>{{ $category->name }}</li>
                            </ul>
                        </div>
                        <div class="flex-none flex space-x-2">
                            <button wire:click="edit({{ $category->id }})" type="button" class="text-blue-500 hover:text-blue-700">
                                <svg class="cursor-pointer h-5" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z"/>
                                    <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"/>
                                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"/>
                                    <line x1="16" y1="5" x2="19" y2="8"/>
                                </svg>
                            </button>
                            <button wire:click="confirmDelete({{ $category->id }})" type="button" class="text-red-500 hover:text-red-700 pr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    @if($showTasks === $category->id)
                        @if(count($category->tasks) > 0)
                            @foreach($category->tasks as $task)
                                <div class="bg-tertiary text-xs text-slate-900 uppercase p-3 w-full cursor-default">{{ $task->name }}</div>
                            @endforeach
                        @else
                            <div class="bg-tertiary text-xs text-slate-900 uppercase p-3 w-full cursor-default">Sem tarefas para essa categoria.</div>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div x-data="{ open: @entangle('confirmingDeletion') }" x-cloak>
        <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-gray-500 bg-opacity-75">
            <div class="bg-white rounded-lg p-6 max-w-sm mx-auto">
                <h2 class="text-xl font-semibold mb-4">Excluir Categoria</h2>
                <p class="mb-4">Tem certeza de que deseja excluir esta categoria? Esta ação não pode ser desfeita.</p>
                <div class="flex justify-end">
                    <button @click="open = false" wire:click="$toggle('confirmingDeletion')" class="px-4 py-2 bg-gray-200 rounded-md mr-2">Cancelar</button>
                    <button wire:click="delete" class="px-4 py-2 bg-red-600 text-white rounded-md">Excluir</button>
                </div>
            </div>
        </div>
    </div>
</div>
