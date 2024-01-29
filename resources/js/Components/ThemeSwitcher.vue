<template>
    <div class="flex justify-center" ref="dropdownContainer">
        <div class="relative">
            <button
                @click="toggleDropdown"
                class="flex text-md border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-500 active:text-gray-600 dark:text-gray-500 dark:hover:text-gray-400 dark:active:text-gray-600"
            >
                <component
                    :is="currentIcon"
                    class="h-6 w-6"
                    aria-hidden="true"
                />
            </button>
            <div
                v-if="isDropdownOpen"
                class="absolute right-0 mt-2 bg-white border border-gray-300 rounded-b shadow-lg dark:bg-gray-800 dark:border-gray-700 rounded"
            >
                <button
                    v-for="item in options"
                    :key="item.value"
                    @click="setOption(item.value)"
                    class="themeColor-center hover:bg-gray-100 py-1 dark:hover:bg-gray-800 w-full text-left cursor-pointer px-3 focus:outline-none focus:ring rounded truncate whitespace-nowrap text-gray-500 active:text-gray-600 dark:text-gray-500 dark:hover:text-gray-400 dark:active:text-gray-600 flex themeColor-center"
                >
                    <component
                        :is="item.icon"
                        class="h-5 w-5"
                        aria-hidden="true"
                    />
                    <span class="ml-2">{{ item.label }}</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch, onMounted, onUnmounted } from "vue";
import {
    SunIcon,
    MoonIcon,
    ComputerDesktopIcon,
} from "@heroicons/vue/20/solid";

const systemDarkMode = window.matchMedia("(prefers-color-scheme: dark)");
const option = ref(localStorage.getItem("option") || "system");
const isDropdownOpen = ref(false);
const dropdownContainer = ref(null);

const options = [
    { value: "light", label: "Light", icon: SunIcon },
    { value: "dark", label: "Dark", icon: MoonIcon },
    { value: "system", label: "System", icon: ComputerDesktopIcon },
];

const toggleDropdown = () => {
    isDropdownOpen.value = !isDropdownOpen.value;
};

const setOption = (selectedOption) => {
    localStorage.setItem("option", selectedOption);
    option.value = selectedOption;
    isDropdownOpen.value = false;
};

const currentIcon = ref(
    options.find((opt) => opt.value === option.value)?.icon ||
        ComputerDesktopIcon
);

const setTheme = () => {
    const theme =
        option.value === "system"
            ? systemDarkMode.matches
                ? "dark"
                : "light"
            : option.value;
    document.documentElement.classList.toggle("dark", theme === "dark");
    currentIcon.value =
        options.find((opt) => opt.value === option.value)?.icon ||
        ComputerDesktopIcon;
};

watch(option, setTheme);

onMounted(() => {
    setTheme();
    systemDarkMode.addListener(setTheme);
    document.addEventListener("click", handleClickOutside);
});

onUnmounted(() => {
    systemDarkMode.removeListener(setTheme);
    document.removeEventListener("click", handleClickOutside);
});

const handleClickOutside = (event) => {
    if (
        isDropdownOpen.value &&
        dropdownContainer.value &&
        !dropdownContainer.value.contains(event.target)
    ) {
        toggleDropdown();
    }
};
</script>
