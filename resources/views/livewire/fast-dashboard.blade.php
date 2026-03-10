<div class="min-h-screen bg-[#0F172A] text-slate-200 p-4 md:p-10 font-sans">
    <div class="max-w-6xl mx-auto">
        <header class="flex flex-col md:flex-row md:items-center justify-between mb-12 gap-6">
            <div>
                <span class="text-indigo-400 font-semibold tracking-widest text-sm uppercase italic">Frontend Engineering Engine</span>
                <h1 class="text-4xl md:text-5xl font-black text-white mt-2 tracking-tight">
                    Figma<span class="text-indigo-500">To</span>Laravel
                </h1>
                <p class="text-slate-400 mt-2 text-lg">High-speed reactive interface built with <span class="text-white border-b-2 border-indigo-500">Livewire 3</span></p>
            </div>
            
            <div class="flex items-center gap-4 bg-slate-800/50 p-4 rounded-2xl border border-slate-700 backdrop-blur-sm">
                <div class="h-12 w-12 rounded-full bg-indigo-500/20 flex items-center justify-center border border-indigo-500/50">
                    <div class="h-3 w-3 bg-indigo-500 rounded-full animate-ping"></div>
                </div>
                <div>
                    <p class="text-xs text-slate-400 uppercase font-bold tracking-tighter">System Status</p>
                    <p class="text-white font-mono text-sm tracking-widest">REALTIME_SYNC_ACTIVE</p>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-slate-800/40 p-8 rounded-3xl border border-slate-700/50 backdrop-blur-xl shadow-2xl">
                    <h2 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Deploy New Task
                    </h2>
                    
                    <form wire:submit.prevent="addTask" class="space-y-5">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Project Specification</label>
                            <input type="text" wire:model="task_name" 
                                class="w-full bg-slate-900/50 border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 transition-all placeholder:text-slate-600 text-white" 
                                placeholder="Enter task name...">
                            @error('task_name') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Priority Level</label>
                            <select wire:model="priority" class="w-full bg-slate-900/50 border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 text-white">
                                <option value="High">🔴 High Priority</option>
                                <option value="Medium">🟡 standard</option>
                                <option value="Low">🟢 Low Maintenance</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-black py-4 rounded-xl shadow-lg shadow-indigo-500/20 transition-all flex justify-center items-center gap-2 group">
                            ADD TO QUEUE
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-8">
                <div class="flex items-center mb-6 bg-slate-800/30 rounded-2xl border border-slate-700/50 p-2 shadow-inner">
                    <div class="pl-4 text-slate-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" wire:model.live="search" 
                        placeholder="Search projects by ID or Name..." 
                        class="bg-transparent border-none w-full focus:ring-0 text-white placeholder:text-slate-500 px-4 py-3 font-mono">
                </div>

                <div class="space-y-4">
                    @forelse($tasks as $task)
                    <div class="group bg-slate-800/20 hover:bg-slate-800/50 border border-slate-700/50 p-5 rounded-2xl flex items-center justify-between transition-all duration-300">
                        <div class="flex items-center gap-6">
                            <div class="h-10 w-10 rounded-xl bg-slate-900 flex items-center justify-center font-mono font-bold text-xs border border-slate-700 text-slate-500 group-hover:border-indigo-500 group-hover:text-indigo-400 transition-colors">
                                #{{ $loop->iteration }}
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-white group-hover:text-indigo-300 transition-colors">{{ $task->task_name }}</h4>
                                <div class="flex items-center gap-3 mt-1 text-xs uppercase tracking-tighter">
                                    <span class="px-2 py-0.5 rounded {{ $task->priority == 'High' ? 'bg-red-500/10 text-red-500' : 'bg-slate-700 text-slate-400' }}">
                                        {{ $task->priority }}
                                    </span>
                                    <span class="text-slate-600 border-l border-slate-700 pl-3">SYNC: {{ $task->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <button wire:click="deleteTask({{ $task->id }})" class="p-3 text-slate-600 hover:text-red-400 hover:bg-red-400/10 rounded-xl transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                    @empty
                    <div class="py-20 text-center border-2 border-dashed border-slate-800 rounded-3xl">
                        <p class="text-slate-600 italic font-mono uppercase tracking-widest">No active tasks in database</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <footer class="mt-20 border-t border-slate-800 pt-8 flex flex-wrap gap-4 justify-center grayscale opacity-50 hover:grayscale-0 hover:opacity-100 transition-all">
            <span class="bg-slate-900 px-4 py-2 rounded-lg text-xs font-bold border border-slate-700 tracking-widest">LARAVEL 12</span>
            <span class="bg-slate-900 px-4 py-2 rounded-lg text-xs font-bold border border-slate-700 tracking-widest">LIVEWIRE 3</span>
            <span class="bg-slate-900 px-4 py-2 rounded-lg text-xs font-bold border border-slate-700 tracking-widest">TAILWIND CSS</span>
            <span class="bg-slate-900 px-4 py-2 rounded-lg text-xs font-bold border border-slate-700 tracking-widest">REST API READY</span>
        </footer>
    </div>

    <div wire:loading class="fixed top-5 right-5 z-50">
        <div class="bg-indigo-600 text-white px-6 py-3 rounded-full shadow-2xl shadow-indigo-500/50 flex items-center gap-3 font-bold text-sm">
            <svg class="animate-spin h-4 w-4 text-white" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            EXECUTING REQUEST...
        </div>
    </div>
</div>