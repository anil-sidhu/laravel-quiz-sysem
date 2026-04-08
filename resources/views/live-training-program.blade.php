<!DOCTYPE html>
<html lang="en">
<head>
    <x-common></x-common>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $program['title'] }} | Live training | The Coding Skills</title>
    <meta name="description" content="{{ $program['title'] }} — {{ $program['subtitle'] ?? '' }}. Instructor-led live program with full curriculum at The Coding Skills." />
    @vite('resources/css/app.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        /* Ensure curriculum lines stay light on dark bg (some browsers inherit dark link colors) */
        .lt-topic-text { color: #f1f5f9 !important; }
        .lt-guarantee { color: #fde68a !important; }
    </style>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
    <x-user-navbar></x-user-navbar>

    @php
        $variants = [
            'mern-hero' => ['from' => '#06b6d4', 'to' => '#7c3aed', 'blob' => 'rgba(6,182,212,0.25)'],
            'mern-master' => ['from' => '#a855f7', 'to' => '#ec4899', 'blob' => 'rgba(168,85,247,0.25)'],
            'mean-hero' => ['from' => '#f59e0b', 'to' => '#ef4444', 'blob' => 'rgba(245,158,11,0.2)'],
            'mean-master' => ['from' => '#10b981', 'to' => '#0ea5e9', 'blob' => 'rgba(16,185,129,0.22)'],
        ];
        $v = $variants[$program['slug']] ?? ['from' => '#7c3aed', 'to' => '#2563eb', 'blob' => 'rgba(124,58,237,0.2)'];
        $topicCount = count($program['topics'] ?? []);
    @endphp

    <!-- Hero -->
    <header class="relative overflow-hidden border-b border-white/5">
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900 via-slate-950 to-slate-950"></div>
        <div class="absolute top-0 right-0 w-[min(100%,480px)] h-[min(100%,480px)] rounded-full blur-3xl opacity-60" style="background: radial-gradient(circle, {{ $v['blob'] }} 0%, transparent 70%);"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 rounded-full blur-3xl opacity-30" style="background: radial-gradient(circle, {{ $v['to'] }}33 0%, transparent 70%);"></div>

        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-14 sm:pt-14 sm:pb-20">
            <nav class="text-sm text-slate-400 mb-8">
                <a href="/" class="text-slate-300 hover:text-white transition-colors no-underline">Home</a>
                <span class="mx-2 text-slate-500">/</span>
                <a href="/#live-training" class="text-slate-300 hover:text-white transition-colors no-underline">Live training</a>
                <span class="mx-2 text-slate-500">/</span>
                <span class="text-slate-100 font-medium">{{ $program['title'] }}</span>
            </nav>

            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider mb-6 border border-white/10 bg-white/5 text-emerald-300/90">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                Live cohort · SMS &amp; WhatsApp updates
            </div>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight mb-4" style="background: linear-gradient(135deg, {{ $v['from'] }}, {{ $v['to'] }}); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                {{ $program['title'] }}
            </h1>
            @if(!empty($program['subtitle']))
            <p class="text-xl text-slate-400 max-w-2xl mb-8">{{ $program['subtitle'] }}</p>
            @endif

            <div class="flex flex-wrap gap-4">
                <a href="tel:+919958194988" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl font-semibold text-white shadow-lg transition hover:opacity-95 hover:scale-[1.02]" style="background: linear-gradient(135deg, {{ $v['from'] }}, {{ $v['to'] }});">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    Call +91 99581 94988
                </a>
                <a href="https://wa.me/919958194988" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl font-semibold bg-emerald-600 hover:bg-emerald-500 text-white border border-emerald-500/50 transition hover:scale-[1.02]">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.435 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    WhatsApp us
                </a>
            </div>

            <p class="lt-guarantee mt-8 max-w-xl rounded-xl border border-amber-400/30 bg-amber-950/50 px-4 py-3 text-sm leading-relaxed shadow-[0_0_28px_-10px_rgba(251,191,36,0.4)]">
                <strong class="text-amber-50">Money-back guarantee</strong> — we stand behind our live training. Ask us for full terms when you call or message.
            </p>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        <div class="flex flex-col lg:flex-row gap-10 lg:gap-14">
            <aside class="lg:w-72 flex-shrink-0">
                <div class="lg:sticky lg:top-24 space-y-6">
                    <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-6 backdrop-blur-sm">
                        <p class="text-slate-400 text-sm mb-1">Curriculum</p>
                        <p class="text-3xl font-bold text-white">{{ $topicCount }}</p>
                        <p class="text-slate-400 text-sm">modules in this track</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-gradient-to-br from-white/5 to-transparent p-6">
                        <p class="text-white font-semibold mb-3">Other programs</p>
                        <ul class="space-y-2">
                            @foreach($allPrograms as $p)
                                @if($p['slug'] !== $program['slug'])
                                <li>
                                    <a href="{{ route('live-training.show', $p['slug']) }}" class="text-slate-300 hover:text-white text-sm transition-colors flex items-center gap-2 group no-underline">
                                        <span class="w-1 h-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity" style="background: {{ $v['from'] }}"></span>
                                        {{ $p['title'] }}
                                    </a>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </aside>

            <div class="flex-1 min-w-0">
                <h2 class="text-2xl sm:text-3xl font-bold text-white mb-2">What you&apos;ll learn</h2>
                <p class="text-slate-400 mb-8">Everything in this program, in order — from core stack skills to interviews and placement support.</p>

                <ul class="space-y-3">
                    @foreach($program['topics'] as $i => $topic)
                    <li class="group flex gap-4 rounded-xl border border-white/5 bg-white/[0.02] hover:border-white/10 hover:bg-white/[0.04] px-4 py-3.5 transition-all">
                        <span class="flex-shrink-0 w-9 h-9 rounded-lg flex items-center justify-center text-sm font-bold text-white" style="background: linear-gradient(135deg, {{ $v['from'] }}99, {{ $v['to'] }}99);">
                            {{ $i + 1 }}
                        </span>
                        <span class="lt-topic-text pt-1 leading-snug font-medium">{{ $topic }}</span>
                    </li>
                    @endforeach
                </ul>

                <div class="mt-12 rounded-2xl border border-white/10 p-8 text-center bg-gradient-to-br from-white/[0.04] to-transparent">
                    <h3 class="text-xl font-bold text-white mb-2">Ready to join?</h3>
                    <p class="text-slate-400 text-sm mb-6 max-w-md mx-auto">Our team will share batch timings, meeting links, and next steps on call or WhatsApp.</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-3">
                        <a href="tel:+919958194988" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl font-semibold text-white" style="background: linear-gradient(135deg, {{ $v['from'] }}, {{ $v['to'] }});">Call now</a>
                        <a href="https://wa.me/919958194988" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl font-semibold border border-emerald-500/40 text-emerald-300 hover:bg-emerald-500/10">Message on WhatsApp</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <x-footer-user></x-footer-user>
</body>
</html>
