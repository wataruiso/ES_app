@props(['editting' => true, 'index' => 1])

<div class="pb-10">
    <span>{{ $index }}問目</span> 
    <div class="grid grid-cols-2 gap-10">
        <div class="flex justify-between items-center">
            <label for="question{{ $index }}">設問タイトル</label>
            <div class="px-3 flex-1">
                {{ $question_input }}
            </div>
            <x-logos.necessary-tag />
        </div>
        <div class="flex items-center">
            <label for="word_count{{ $index }}">文字数</label>
            <div class="px-3">
                {{ $word_count_input }}
            </div>
            <x-logos.necessary-tag />
        </div>
    </div>
</div>
<template x-if="'{{ $editting }}'">
    <div class="mb-5 flex">
        <div class="pr-5">
            <div class="flex flex-col py-5">
                <span x-text="'現在の文字数：' + answer.length"></span>
            </div>
            <div class="text-sm">
                <a href="#" @click.prevent="answer = answer.replace(/\s+/g, '');" class="pr-3">空白を削除</a>
                <a href="#" @click.prevent="answer = answer.replace(/[A-Za-z0-9]/g, function(s) {
                    return String.fromCharCode(s.charCodeAt(0) + 0xFEE0);
                    });">全角に変換
                </a>
            </div>
        </div>
        {{ $answer ?? '' }}
    </div>
</template>