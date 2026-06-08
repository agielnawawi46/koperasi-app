@extends('layouts.app')

@section('sidebar')
    @include('layouts.sidebar.pengurus')
@endsection

@section('content')

<div id="mainContent" class="px-8 py-8 space-y-8 animate-fade-in">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="space-y-1">
            <div class="flex items-center gap-3">
                <h1 class="text-3xl font-black text-slate-800 tracking-tight">Log Simpanan</h1>
            </div>
            <p class="text-slate-500 font-medium ml-1">Data simpanan masuk (Pokok, Wajib, Sukarela).</p>
        </div>
        
        <div class="flex items-center gap-3">
            <button onclick="openSetoranModal()" class="group flex items-center gap-2 px-5 py-3.5 bg-emerald-600 text-white font-bold rounded-2xl shadow-xl shadow-emerald-200 hover:bg-emerald-700 transition-all active:scale-95">
                <div class="p-1.5 bg-emerald-500 group-hover:bg-emerald-400 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                </div>
                Input Setoran (Bayar Langsung)
            </button>
        </div>
    </div>

    {{-- ================= RINGKASAN CARDS ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        @php
            $stats = [
                ['label' => 'Total Pokok', 'val' => number_format($totalPokok), 'icon' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z', 'color' => 'blue'],
                ['label' => 'Total Wajib', 'val' => number_format($totalWajib), 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'color' => 'indigo'],
                ['label' => 'Total Sukarela', 'val' => number_format($totalSukarela), 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'purple'],
                ['label' => 'Periode Aktif', 'val' => strtoupper(now()->translatedFormat('F Y')), 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'color' => 'emerald'],
            ];
        @endphp
        
        @foreach($stats as $stat)
        <div class="group relative bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-500">
            <div class="absolute top-0 right-0 w-32 h-32 bg-{{ $stat['color'] }}-50 rounded-bl-[80px] transition-all group-hover:w-full group-hover:h-full group-hover:rounded-none group-hover:opacity-40 duration-700"></div>
            
            <div class="relative z-10 space-y-6">
                <div class="flex items-center justify-between">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 group-hover:text-{{ $stat['color'] }}-700 transition-colors uppercase">{{ $stat['label'] }}</p>
                    <div class="p-4 bg-{{ $stat['color'] }}-100 text-{{ $stat['color'] }}-600 rounded-2xl shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}" /></svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tabular-nums">
                        @if($stat['label'] != 'Periode Aktif') <span class="text-sm font-bold text-slate-400 uppercase mr-1">Rp</span> @endif
                        {{ $stat['val'] }}
                    </h2>
                    <div class="mt-2 inline-flex items-center px-3 py-1.5 rounded-xl text-[10px] font-black bg-{{ $stat['color'] }}-100/50 text-{{ $stat['color'] }}-700 border border-{{ $stat['color'] }}-200 uppercase tracking-widest">
                        @if($stat['label'] == 'Periode Aktif') Terjadwal Otomatis @else Terakumulasi @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ================= RIWAYAT ACCORDION ================= --}}
    <div x-data="{ expanded: null }" class="space-y-4 animate-slide-up mt-8">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-black text-slate-800">Riwayat Transaksi</h2>
                <p class="text-sm text-slate-400 font-medium">{{ count($transaksi) }} transaksi simpanan tercatat</p>
            </div>
        </div>

        @forelse($transaksi as $t)
        @php
            $pm = $t->payment_method ?? '-';
            $pmStyles = [
                'transfer_bank' => 'bg-blue-50 text-blue-700 border-blue-200',
                'bayar_langsung' => 'bg-amber-50 text-amber-700 border-amber-200',
                'potong_gaji' => 'bg-purple-50 text-purple-700 border-purple-200',
                'otomatis'   => 'bg-slate-50 text-slate-700 border-slate-200',
            ];
            $pmLabels = [
                'transfer_bank' => 'Transfer Bank',
                'bayar_langsung' => 'Bayar Langsung',
                'potong_gaji' => 'Potong Gaji',
                'otomatis'   => 'Otomatis',
            ];
            $statusStyles = [
                'pending'  => 'bg-amber-50 text-amber-700 border-amber-200',
                'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                'rejected' => 'bg-rose-50 text-rose-700 border-rose-200',
            ];
            $statusLabels = [
                'pending'  => 'Pending',
                'approved' => 'Verified',
                'rejected' => 'Ditolak',
            ];
            $s = $t->status ?? 'pending';
        @endphp
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden transition-all duration-300"
             :class="expanded === {{ $t->id }} ? 'shadow-lg ring-1 ring-slate-200' : 'hover:shadow-md'">
            <button type="button"
                @click="expanded = expanded === {{ $t->id }} ? null : {{ $t->id }}"
                class="w-full flex items-center justify-between p-6 text-left">
                <div class="flex items-center gap-4 min-w-0">
                    <div class="w-12 h-12 bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl flex items-center justify-center font-black text-slate-600 shrink-0">
                        {{ strtoupper(substr($t->user->name ?? '?', 0, 2)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="font-black text-slate-800 truncate">{{ $t->user->name ?? 'Unknown' }}</p>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="inline-flex items-center gap-1 px-3 py-0.5 text-[9px] font-black rounded-lg border tracking-wide"
                                  :class="{
                                      'bg-blue-50 text-blue-700 border-blue-200': '{{ $t->type }}' === 'sukarela',
                                      'bg-indigo-50 text-indigo-700 border-indigo-200': '{{ $t->type }}' === 'wajib',
                                  }">
                                {{ ucfirst($t->type) }}
                            </span>
                            <span class="text-[9px] font-bold text-slate-400">{{ $t->created_at->format('d M, H:i') }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-5 shrink-0">
                    <div class="text-right">
                        <p class="text-base font-black text-emerald-600">+ Rp {{ number_format($t->amount) }}</p>
                        <span class="inline-flex items-center gap-1 text-[9px] font-black rounded-lg uppercase tracking-wide px-2 py-0.5 {{ $statusStyles[$s] ?? 'bg-slate-50 text-slate-700 border-slate-200' }}">
                            {{ $statusLabels[$s] ?? ucfirst($s) }}
                        </span>
                    </div>
                    <svg class="w-5 h-5 text-slate-300 transition-transform duration-300 shrink-0"
                         :class="expanded === {{ $t->id }} ? 'rotate-180' : ''"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </button>

            <div x-show="expanded === {{ $t->id }}" x-cloak
                 x-transition:enter="transition-all duration-300 ease-out"
                 x-transition:enter-start="opacity-0 max-h-0 overflow-hidden"
                 x-transition:enter-end="opacity-100 max-h-96"
                 class="border-t border-slate-50">
                <div class="p-6 bg-slate-50/30 space-y-5">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">ID Transaksi</p>
                            <p class="text-sm font-black text-blue-600 font-mono">#{{ $t->reference ?? 'TRX-'.$t->id }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Tanggal</p>
                            <p class="text-sm font-black text-slate-700">{{ $t->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Metode</p>
                            <span class="inline-flex items-center text-[10px] font-black px-3 py-1 rounded-xl border uppercase tracking-wide {{ $pmStyles[$pm] ?? 'bg-slate-50 text-slate-700 border-slate-200' }}">
                                {{ $pmLabels[$pm] ?? $pm }}
                            </span>
                        </div>
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1">Keterangan</p>
                            <p class="text-sm font-black text-slate-700">{{ $t->description ?? '-' }}</p>
                        </div>
                    </div>

                    @if ($s === 'pending')
                    <div class="flex gap-3 pt-2 border-t border-slate-100">
                        <form action="{{ route('pengurus.transsimpanan.approve', $t) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-6 py-3 bg-emerald-600 text-white text-xs font-black uppercase tracking-widest rounded-2xl hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-200 active:scale-95">
                                Setujui
                            </button>
                        </form>
                        <form action="{{ route('pengurus.transsimpanan.reject', $t) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-6 py-3 bg-rose-500 text-white text-xs font-black uppercase tracking-widest rounded-2xl hover:bg-rose-600 transition-all shadow-lg shadow-rose-200 active:scale-95">
                                Tolak
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-16 text-center">
            <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4a2 2 0 012-2m16 0h-4m-8 0H4m8 2v5m4-7V5a1 1 0 112 0v1a1 1 0 01-1 1h-1z"/></svg>
            </div>
            <p class="font-bold text-slate-400 italic">Belum ada transaksi simpanan.</p>
        </div>
        @endforelse
    </div>
</div>

    {{-- ================= MODAL INPUT SETORAN (Bayar Langsung) ================= --}}
    <div id="modalSetoran" class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm transition-all duration-300 hidden">

        <div class="bg-white w-full max-w-lg rounded-[3rem] shadow-2xl p-10 border border-slate-100 relative overflow-hidden transition-all duration-300 scale-95 translate-y-10">

            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-full -z-0"></div>

            <div class="relative z-10">
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h3 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Input Setoran</h3>
                        <p class="text-[10px] text-emerald-600 font-black uppercase tracking-widest mt-1">Bayar Langsung oleh Anggota</p>
                    </div>
                    <button onclick="closeSetoranModal()" class="text-slate-300 hover:text-rose-500 transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('pengurus.transsimpanan.store') }}" method="POST" class="space-y-6"
                      x-data="{
                          searchQuery: '',
                          selectedMember: null,
                          selectedMemberId: '',
                          showDropdown: false,
                          paymentMethod: '{{ $organization?->payment_method ?? 'Transfer Manual' }}',
                          anggota: window._ANGGOTA || [],
                          get filteredAnggota() {
                              if (!this.searchQuery || this.searchQuery.length < 1) return [];
                              const q = this.searchQuery.toLowerCase();
                              return this.anggota.filter(a => a.name.toLowerCase().includes(q) || (a.member_code && a.member_code.toLowerCase().includes(q)));
                          },
                          pilihAnggota(a) {
                              this.selectedMember = a;
                              this.selectedMemberId = a.id;
                              this.searchQuery = a.name;
                              this.showDropdown = false;
                          }
                      }">
                    @csrf
                    <input type="hidden" name="payment_method" value="bayar_langsung">

                    <div class="relative" @click.outside="showDropdown = false">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Anggota</label>
                        <div class="relative">
                            <svg class="absolute left-5 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-300 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            <input type="text"
                                x-model="searchQuery"
                                @input="showDropdown = true; selectedMember = null; selectedMemberId = ''"
                                @focus="showDropdown = true"
                                placeholder="Cari anggota..."
                                class="w-full bg-slate-50 border-none rounded-2xl pl-14 pr-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all placeholder:font-medium">
                        </div>
                        <input type="hidden" name="user_id" x-model="selectedMemberId">

                        <div x-show="showDropdown && filteredAnggota.length > 0"
                            class="absolute z-20 mt-2 w-full bg-white rounded-2xl shadow-xl border border-slate-100 max-h-56 overflow-y-auto"
                            x-cloak>
                            <template x-for="a in filteredAnggota" :key="a.id">
                                <button type="button"
                                    @click="pilihAnggota(a)"
                                    class="flex items-center gap-4 w-full px-5 py-4 text-left hover:bg-blue-50 transition-all border-b border-slate-50 last:border-0"
                                    :class="selectedMemberId == a.id ? 'bg-blue-50' : ''">
                                    <div class="w-10 h-10 bg-gradient-to-br from-slate-100 to-slate-200 rounded-xl flex items-center justify-center font-black text-slate-600 text-sm shrink-0"
                                        x-text="a.name.charAt(0)"></div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-black text-slate-800 truncate" x-text="a.name"></p>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wide" x-text="a.member_code"></p>
                                    </div>
                                </button>
                            </template>
                        </div>
                    </div>

                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Tipe Simpanan</label>
                        <select name="type" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all" required>
                            <option value="">Pilih Tipe</option>
                            <template x-if="paymentMethod === 'Transfer Manual'">
                                <option value="wajib">Simpanan Wajib</option>
                            </template>
                            <option value="sukarela">Simpanan Sukarela</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Nominal (Rp)</label>
                        <input type="number" name="amount" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="0" required>
                    </div>

                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Keterangan</label>
                        <input type="text" name="description" class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Misal: Bayar langsung ke pengurus">
                    </div>

                    <button type="submit" class="w-full py-4 bg-emerald-600 text-white font-black text-[10px] uppercase tracking-[0.2em] rounded-2xl shadow-xl hover:bg-emerald-700 transition-all active:scale-95">
                        Simpan Setoran
                    </button>
                </form>
            </div>
        </div>
    </div>

<script>
    window._ANGGOTA = @json(\App\Models\User::role('anggota')->orderBy('name')->get(['id', 'name', 'member_code']));
</script>

<script>
    function openSetoranModal() {
        const modal = document.getElementById('modalSetoran');
        const content = modal.querySelector('div');
        modal.classList.remove('hidden');
        requestAnimationFrame(() => {
            content.classList.remove('scale-95', 'translate-y-10');
            content.classList.add('scale-100', 'translate-y-0');
        });
    }

    function closeSetoranModal() {
        const modal = document.getElementById('modalSetoran');
        const content = modal.querySelector('div');
        content.classList.remove('scale-100', 'translate-y-0');
        content.classList.add('scale-95', 'translate-y-10');
        setTimeout(() => modal.classList.add('hidden'), 300);
    }

    document.addEventListener('click', function(event) {
        const modal = document.getElementById('modalSetoran');
        if (!modal.classList.contains('hidden') && event.target === modal) {
            closeSetoranModal();
        }
    });
</script>

<style>
    @keyframes fade-in { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slide-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fade-in 0.6s ease-out forwards; }
    .animate-slide-up { animation: slide-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
</style>

@endsection