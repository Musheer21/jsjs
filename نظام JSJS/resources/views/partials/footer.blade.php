<div style="position: fixed; bottom: 10px; left: 50%; transform: translateX(-50%); font-size: 0.75rem; opacity: 0.6; color: inherit; z-index: 9999; pointer-events: none; text-align: center; width: 100%; font-family: 'Amiri', serif;">
    @isset($supervisor)
        <div style="margin-bottom: 5px; font-weight: bold;">المشرف: {{ $supervisor }}</div>
    @endisset
    <div>حقوق النشر لدى ABM &copy; {{ date('Y') }}</div>
</div>
