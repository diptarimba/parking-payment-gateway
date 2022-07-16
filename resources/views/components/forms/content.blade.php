<x-dynamic-component :component="'form.'.$slotContent->contentType->form" 
    :value="json_decode($translation->content)" 
    :label="$slotContent->contentType->name" 
    name="content" 
    :props="$props"
/>
