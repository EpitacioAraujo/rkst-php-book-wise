<style type="text/tailwindcss">
    @layer base {
        html, body {}
    }

    @layer components {
        .btn {
            @apply inline-flex items-center justify-center px-3 py-1 
                    rounded-md shadow-sm transition-all duration-200
                    text-white bg-stone-800 
                    hover:bg-stone-700
                    focus:ring-stone-500 focus:outline-[0] focus:ring-2;
        }

        .btn-success {
            @apply bg-emerald-800 hover:bg-emerald-700 focus:ring-emerald-500;
        }

        .btn-secondary {
            @apply bg-stone-100 hover:bg-stone-700 focus:ring-stone-500 text-stone-800;
        }
    }
</style>