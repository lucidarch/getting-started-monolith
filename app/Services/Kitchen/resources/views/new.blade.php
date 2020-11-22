<x-app-layout>
    <x-slot name="header">
        Add Recipe
    </x-slot>

    <div class="form-container">
        <form action="/kitchen/recipes" method="post" class="form">
            @csrf
            @if ($errors->any())
                <div class="form-error-status-message" role="alert">
                    Please fix the following errors
                </div>
            @endif
            <div class="form-input-row">
                <div class="md:w-1/3">
                    <label class="form-label" for="title">
                        Title
                    </label>
                </div>
                <div class="md:w-2/3">
                    <input id="title"
                           type="text"
                           name="title"
                           value="{{ old('title', 'Greek Salad') }}"
                           placeholder="Greek Salad"
                           class="form-input">
                    @error('title')
                    <p class="form-input-error-label">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-input-row">
                <div class="md:w-1/3">
                    <label for="ingredients" class="form-label" for="desription">
                        Ingredients
                    </label>
                </div>
                <div class="md:w-2/3">
                    <p class="text-gray-500 text-xs">each ingredient on a new line.</p>
                    <p class="text-gray-500 text-xs">Ingredient, mass /g, $ /g</p>
                    <textarea id="ingredients"
                              name="ingredients"
                              class="form-input h-48"
                              placeholder="Avocado, 0.5, 0.07
                              Lettuce, 0.3, 0.04">{{ old('ingredients', "Avocado, 0.5, 0.07\nLettuce, 0.3, 0.04") }}</textarea>
                    @error('ingredients')
                    <p class="form-input-error-label">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-input-row">
                <div class="md:w-1/3">
                    <label for="instructions" class="form-label" for="desription">
                        Instructions
                    </label>
                </div>
                <div class="md:w-2/3">
                    <textarea id="instructions"
                              name="instructions"
                              class="form-input h-24"
                              placeholder="How to do it?">{{ old('instructions', "• Cut the lettuce\n• Cut avocado in squares\n• Cut Feta in squares\n• Add olive oil\n• Enjoy!") }}</textarea>
                </div>
            </div>

            <div class="md:flex md:items-center">
                <div class="md:w-1/3"></div>
                <div class="md:w-2/3">
                    <button type="submit" class="btn">
                        Add
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
