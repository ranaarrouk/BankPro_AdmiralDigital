<!--
  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<template>
    <!--
      This example requires updating your template:

      ```
      <html class="h-full bg-white">
      <body class="h-full">
      ```
    -->
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <div class="flex justify-center sm:mx-auto sm:w-full sm:max-w-sm">
                <svg fill="#000000" class="w-8 h-8 flex items-center text-indigo-700" version="1.1" id="Layer_1"
                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     viewBox="0 0 512.003 512.003" xml:space="preserve">
<g>
	<g>
		<g>
			<path d="M76.802,409.602c-4.71,0-8.533,3.823-8.533,8.533s3.823,8.533,8.533,8.533h85.333c4.71,0,8.533-3.823,8.533-8.533
				s-3.823-8.533-8.533-8.533h-8.533v-204.8h8.533c4.71,0,8.533-3.823,8.533-8.533s-3.823-8.533-8.533-8.533H76.802
				c-4.71,0-8.533,3.823-8.533,8.533s3.823,8.533,8.533,8.533h8.533v204.8H76.802z M102.402,204.802h34.133v204.8h-34.133V204.802z"
            />
            <path d="M8.535,170.668h494.933c3.814,0,7.159-2.526,8.209-6.195c1.041-3.661-0.469-7.578-3.712-9.591L260.499,1.282
				c-2.756-1.707-6.238-1.707-8.994,0L4.038,154.882c-3.243,2.014-4.753,5.931-3.712,9.591
				C1.375,168.142,4.721,170.668,8.535,170.668z M256.002,18.579l217.54,135.023H38.461L256.002,18.579z"/>
            <path d="M34.135,452.268c0,4.71,3.823,8.533,8.533,8.533h426.667c4.71,0,8.533-3.823,8.533-8.533c0-4.71-3.823-8.533-8.533-8.533
				H42.668C37.958,443.735,34.135,447.558,34.135,452.268z"/>
            <path d="M503.468,477.868H8.535c-4.71,0-8.533,3.823-8.533,8.533v17.067c0,4.71,3.823,8.533,8.533,8.533s8.533-3.823,8.533-8.533
				v-8.533h477.867v8.533c0,4.71,3.823,8.533,8.533,8.533s8.533-3.823,8.533-8.533v-17.067
				C512.002,481.691,508.179,477.868,503.468,477.868z"/>
            <path d="M213.335,409.602c-4.71,0-8.533,3.823-8.533,8.533s3.823,8.533,8.533,8.533h85.333c4.71,0,8.533-3.823,8.533-8.533
				s-3.823-8.533-8.533-8.533h-8.533v-204.8h8.533c4.71,0,8.533-3.823,8.533-8.533s-3.823-8.533-8.533-8.533h-85.333
				c-4.71,0-8.533,3.823-8.533,8.533s3.823,8.533,8.533,8.533h8.533v204.8H213.335z M238.935,204.802h34.133v204.8h-34.133V204.802z
				"/>
            <path d="M349.868,409.602c-4.71,0-8.533,3.823-8.533,8.533s3.823,8.533,8.533,8.533h85.333c4.71,0,8.533-3.823,8.533-8.533
				s-3.823-8.533-8.533-8.533h-8.533v-204.8h8.533c4.71,0,8.533-3.823,8.533-8.533s-3.823-8.533-8.533-8.533h-85.333
				c-4.71,0-8.533,3.823-8.533,8.533s3.823,8.533,8.533,8.533h8.533v204.8H349.868z M375.468,204.802h34.133v204.8h-34.133V204.802z
				"/>
		</g>
	</g>
</g>
</svg>
            </div>
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your
                account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="#" method="POST">
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" required=""
                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                        <div class="text-sm">
                            <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                        </div>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required=""
                               class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Sign in
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Not a member?
                {{ ' ' }}
                <a href="#" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Start a 14 day free
                    trial</a>
            </p>
        </div>
    </div>
</template>
