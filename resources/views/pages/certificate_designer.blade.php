<x-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="container mx-auto p-6 pt-10">
            <div class="flex items-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Certificate Designer</h1>
                <div class="ml-3 px-3 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Pro</div>
            </div>

            <!-- Upload Background -->
            <form action="/certificate-designer/upload" method="POST" enctype="multipart/form-data" class="mb-6 bg-white p-5 rounded-lg shadow-sm">
                @csrf
                <label class="block text-sm font-medium text-gray-700 mb-2">Upload Certificate Background:</label>
                <div class="flex items-center gap-3">
                    <input type="file" name="background" class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Upload
                    </button>
                </div>
            </form>

            @if(isset($backgroundPath))
            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Canvas -->
                <div id="design-area" class="flex-1 relative border border-gray-300 rounded-lg overflow-hidden bg-white shadow-md" style="min-height: 600px; max-width: 800px;">
                    <img src="{{ asset('storage/' . $backgroundPath) }}" class="w-full" />
                </div>

                <!-- Tools Panel -->
                <div class="w-full lg:w-80 bg-white rounded-lg shadow-md p-5">
                    <div class="border-b border-gray-200 pb-4 mb-4">
                        <h2 class="font-bold text-gray-800 mb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Editing Tools
                        </h2>

                        <div class="space-y-3">
                            <div>
                                <label class="text-xs font-medium text-gray-600 block">Font</label>
                                <select id="fontSelect" class="mt-1 w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option value="Arial">Arial</option>
                                    <option value="Times New Roman">Times New Roman</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Courier New">Courier New</option>
                                    <option value="Verdana">Verdana</option>
                                    <option value="Tahoma">Tahoma</option>
                                    <option value="Impact">Impact</option>
                                    <option value="Montserrat">Montserrat</option>
                                    <option value="Playfair Display">Playfair Display</option>
                                </select>
                            </div>

                            <div>
                                <label class="text-xs font-medium text-gray-600 block">Font Size</label>
                                <input type="number" id="fontSizeInput" value="18" min="8" max="72" class="mt-1 w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                            </div>

                            <div>
                                <label class="text-xs font-medium text-gray-600 block">Text Color</label>
                                <div class="flex items-center mt-1">
                                    <input type="color" id="colorInput" class="w-10 h-10 rounded overflow-hidden" />
                                    <span id="colorHex" class="ml-2 text-xs text-gray-500">#000000</span>
                                </div>
                            </div>

                            <!-- Shape Color (Only shown when a shape is selected) -->
                            <div id="shapeColorSection" class="hidden">
                                <label class="text-xs font-medium text-gray-600 block">Shape Color</label>
                                <div class="flex items-center mt-1">
                                    <input type="color" id="shapeColorInput" value="#9333ea" class="w-10 h-10 rounded overflow-hidden" />
                                    <span id="shapeColorHex" class="ml-2 text-xs text-gray-500">#9333ea</span>
                                </div>
                            </div>

                            <div class="flex gap-2 mt-2">
                                <button id="boldBtn" onclick="toggleStyle('bold')" class="p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none" title="Bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.5 10a3.5 3.5 0 11-7 0 3.5 3.5 0 017 0zm-3.5 5a5 5 0 100-10 5 5 0 000 10z" />
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm0-2a6 6 0 100-12 6 6 0 000 12z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button id="italicBtn" onclick="toggleStyle('italic')" class="p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none" title="Italic">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M14 5h-4v2h2.58l-3.66 7H6v2h4v-2H7.42l3.66-7H14z" />
                                    </svg>
                                </button>
                                <button id="underlineBtn" onclick="toggleStyle('underline')" class="p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none" title="Underline">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M7 3C6.44772 3 6 3.44772 6 4V10C6 12.2091 7.79086 14 10 14C12.2091 14 14 12.2091 14 10V4C14 3.44772 13.5523 3 13 3C12.4477 3 12 3.44772 12 4V10C12 11.1046 11.1046 12 10 12C8.89543 12 8 11.1046 8 10V4C8 3.44772 7.55228 3 7 3Z" />
                                        <path d="M5 17C5 16.4477 5.44772 16 6 16H14C14.5523 16 15 16.4477 15 17C15 17.5523 14.5523 18 14 18H6C5.44772 18 5 17.5523 5 17Z" />
                                    </svg>
                                </button>
                                <button id="alignLeftBtn" onclick="alignText('left')" class="p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none" title="Align Left">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button id="alignCenterBtn" onclick="alignText('center')" class="p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none" title="Align Center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button id="alignRightBtn" onclick="alignText('right')" class="p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none" title="Align Right">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 10a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>

                            <div>
                                <label class="text-xs font-medium text-gray-600 block">Text Content</label>
                                <textarea id="textContentInput" rows="2" class="mt-1 w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
                            </div>

                            <div class="flex gap-2">
                                <button onclick="applyStyles()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md text-sm font-medium transition-colors duration-200 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Apply Style
                                </button>
                                
                                <button id="deleteElementBtn" onclick="deleteSelectedElement()" class="bg-red-500 hover:bg-red-600 text-white py-2 px-3 rounded-md text-sm font-medium transition-colors duration-200 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="border-b border-gray-200 pb-4 mb-4">
                        <h2 class="font-bold text-gray-800 mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Add Elements
                        </h2>
                        
                        <div class="grid grid-cols-2 gap-2">
                            <button onclick="addTextElement()" class="flex items-center justify-center bg-green-50 hover:bg-green-100 text-green-700 py-2 px-3 rounded-md text-sm transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                </svg>
                                Text
                            </button>
                            
                            <button onclick="addImageElement()" class="flex items-center justify-center bg-yellow-50 hover:bg-yellow-100 text-yellow-700 py-2 px-3 rounded-md text-sm transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Image
                            </button>
                            
                            <button onclick="addSignatureElement()" class="flex items-center justify-center bg-indigo-50 hover:bg-indigo-100 text-indigo-700 py-2 px-3 rounded-md text-sm transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                E-Signature
                            </button>
                            
                            <div class="relative group">
                                <button id="shapeBtn" class="flex items-center justify-center w-full bg-purple-50 hover:bg-purple-100 text-purple-700 py-2 px-3 rounded-md text-sm transition-colors duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>
                                    Shapes
                                </button>
                                <div id="shapeDropdown" class="hidden absolute right-0 mt-1 w-48 bg-white rounded-md shadow-lg z-10 p-2 grid grid-cols-3 gap-1">
                                    <button onclick="addShape('rect')" class="p-2 hover:bg-gray-100 rounded focus:outline-none" title="Rectangle">
                                        <div class="w-full h-6 bg-purple-200 rounded"></div>
                                    </button>
                                    <button onclick="addShape('circle')" class="p-2 hover:bg-gray-100 rounded focus:outline-none" title="Circle">
                                        <div class="w-6 h-6 bg-purple-200 rounded-full mx-auto"></div>
                                    </button>
                                    <button onclick="addShape('triangle')" class="p-2 hover:bg-gray-100 rounded focus:outline-none" title="Triangle">
                                        <div class="w-0 h-0 border-l-[12px] border-r-[12px] border-b-[20px] border-l-transparent border-r-transparent border-b-purple-200 mx-auto"></div>
                                    </button>
                                    <button onclick="addShape('diamond')" class="p-2 hover:bg-gray-100 rounded focus:outline-none" title="Diamond">
                                        <div class="w-6 h-6 bg-purple-200 mx-auto transform rotate-45"></div>
                                    </button>
                                    <button onclick="addShape('star')" class="p-2 hover:bg-gray-100 rounded focus:outline-none" title="Star">
                                        <div class="text-purple-200 text-lg text-center">★</div>
                                    </button>
                                    <button onclick="addShape('hexagon')" class="p-2 hover:bg-gray-100 rounded focus:outline-none" title="Hexagon">
                                        <div class="w-6 h-6 bg-purple-200 mx-auto clip-hexagon"></div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="flex mb-4">
                            <button onclick="saveDesign()" class="w-full bg-indigo-700 hover:bg-indigo-800 text-white py-2 px-4 rounded-md text-sm font-medium transition-colors duration-200 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                Save Design
                            </button>
                        </div>
                        <div class="flex gap-2">
                            <button onclick="downloadCertificate()" class="flex-1 bg-green-600 hover:bg-green-700 text-white py-2 px-2 rounded-md text-xs font-medium transition-colors duration-200 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Export
                            </button>
                            <button onclick="clearDesign()" class="flex-1 bg-red-500 hover:bg-red-600 text-white py-2 px-2 rounded-md text-xs font-medium transition-colors duration-200 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Clear All
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <style>
        .clip-hexagon {
            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        }
        
        /* Resize handle styles */
        .resize-handle {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #3b82f6;
            border-radius: 50%;
            z-index: 10;
        }
        
        .resize-handle.tl { top: -5px; left: -5px; cursor: nwse-resize; }
        .resize-handle.tr { top: -5px; right: -5px; cursor: nesw-resize; }
        .resize-handle.bl { bottom: -5px; left: -5px; cursor: nesw-resize; }
        .resize-handle.br { bottom: -5px; right: -5px; cursor: nwse-resize; }
        
        /* Delete button styles */
        .element-delete-btn {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 20px;
            height: 20px;
            background-color: #ef4444;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            z-index: 20;
            opacity: 0;
            transition: opacity 0.2s;
        }
        
        .element-container:hover .element-delete-btn,
        .element-delete-btn.active {
            opacity: 1;
        }
    </style>

    <script>
        // Global variables
        let selectedElement = null;
        let isShapeDropdownOpen = false;

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            // Handle shape dropdown
            const shapeBtn = document.getElementById('shapeBtn');
            const shapeDropdown = document.getElementById('shapeDropdown');
            
            if (shapeBtn && shapeDropdown) {
                shapeBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    isShapeDropdownOpen = !isShapeDropdownOpen;
                    shapeDropdown.classList.toggle('hidden', !isShapeDropdownOpen);
                });
                
                document.addEventListener('click', function() {
                    if (isShapeDropdownOpen) {
                        shapeDropdown.classList.add('hidden');
                        isShapeDropdownOpen = false;
                    }
                });
            }
            
            // Update color hex display for text color
            const colorInput = document.getElementById('colorInput');
            const colorHex = document.getElementById('colorHex');
            
            if (colorInput && colorHex) {
                colorInput.addEventListener('input', function() {
                    colorHex.textContent = colorInput.value;
                });
            }
            
            // Update color hex display for shape color
            const shapeColorInput = document.getElementById('shapeColorInput');
            const shapeColorHex = document.getElementById('shapeColorHex');
            
            if (shapeColorInput && shapeColorHex) {
                shapeColorInput.addEventListener('input', function() {
                    shapeColorHex.textContent = shapeColorInput.value;
                    
                    // Apply color directly if a shape is selected
                    if (selectedElement && selectedElement.dataset.shapeType) {
                        applyShapeColor();
                    }
                });
            }
        });

        // Text element functions
        function addTextElement() {
            const container = document.createElement('div');
            container.className = 'absolute element-container';
            container.style.position = 'absolute';
            container.style.top = '100px';
            container.style.left = '100px';
            
            const div = document.createElement('div');
            div.contentEditable = true;
            div.innerText = 'Certificate Text';
            div.className = 'px-2 py-1 select-none';
            Object.assign(div.style, {
                fontSize: '18px',
                fontFamily: 'Arial',
                color: '#000',
                cursor: 'move',
                minWidth: '50px',
                minHeight: '20px',
                textAlign: 'left'
            });

            // Add delete button
            const deleteBtn = createDeleteButton();
            container.appendChild(div);
            container.appendChild(deleteBtn);

            container.onclick = (e) => {
                e.stopPropagation();
                selectElement(container);
            };
            makeDraggable(container);
            document.getElementById('design-area').appendChild(container);
            selectElement(container);
        }

        // Image element functions
        function addImageElement() {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.onchange = () => {
                const file = input.files[0];
                const reader = new FileReader();
                reader.onload = (e) => {
                    const container = document.createElement('div');
                    container.className = 'absolute element-container';
                    container.style.position = 'absolute';
                    container.style.top = '150px';
                    container.style.left = '150px';
                    container.style.cursor = 'move';
                    container.style.border = '1px dashed transparent';
                    
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '150px';
                    img.style.display = 'block';
                    img.style.userSelect = 'none';
    img.draggable = false;
    
    // Add delete button
    const deleteBtn = createDeleteButton();
    container.appendChild(img);
    container.appendChild(deleteBtn);
    
    // Add resize handles
    addResizeHandles(container);
    
    container.onclick = (e) => {
        e.stopPropagation();
        selectElement(container);
    };
    
    makeDraggable(container);
    document.getElementById('design-area').appendChild(container);
    selectElement(container);
                };
                reader.readAsDataURL(file);
            };
            input.click();
        }

        // Signature element functions
        function addSignatureElement() {
            const container = document.createElement('div');
            container.className = 'absolute element-container';
            container.style.position = 'absolute';
            container.style.top = '200px';
            container.style.left = '200px';
            container.dataset.type = 'signature';
            
            const div = document.createElement('div');
            div.contentEditable = true;
            div.innerText = 'Signature Name';
            div.className = 'px-2 py-1 select-none signature-text';
            Object.assign(div.style, {
                fontSize: '18px',
                fontFamily: 'Cursive, Arial',
                color: '#000',
                cursor: 'move',
                minWidth: '100px',
                minHeight: '20px',
                textAlign: 'center',
                borderBottom: '1px solid #000'
            });

            // Add delete button
            const deleteBtn = createDeleteButton();
            container.appendChild(div);
            container.appendChild(deleteBtn);
            
            // Add resize handles
            addResizeHandles(container);

            container.onclick = (e) => {
                e.stopPropagation();
                selectElement(container);
            };
            makeDraggable(container);
            document.getElementById('design-area').appendChild(container);
            selectElement(container);
        }

        // Shape element functions
        function addShape(shapeType) {
            // Close dropdown
            document.getElementById('shapeDropdown').classList.add('hidden');
            isShapeDropdownOpen = false;
            
            const container = document.createElement('div');
            container.className = 'absolute element-container';
            container.style.position = 'absolute';
            container.style.top = '150px';
            container.style.left = '250px';
            container.dataset.shapeType = shapeType;
            
            let shape;
            const shapeColor = document.getElementById('shapeColorInput').value || '#9333ea';
            
            switch(shapeType) {
                case 'rect':
                    shape = document.createElement('div');
                    Object.assign(shape.style, {
                        width: '100px',
                        height: '60px',
                        backgroundColor: shapeColor,
                        borderRadius: '4px'
                    });
                    break;
                case 'circle':
                    shape = document.createElement('div');
                    Object.assign(shape.style, {
                        width: '80px',
                        height: '80px',
                        backgroundColor: shapeColor,
                        borderRadius: '50%'
                    });
                    break;
                case 'triangle':
                    shape = document.createElement('div');
                    Object.assign(shape.style, {
                        width: '0',
                        height: '0',
                        borderLeft: '40px solid transparent',
                        borderRight: '40px solid transparent',
                        borderBottom: '70px solid ' + shapeColor
                    });
                    break;
                case 'diamond':
                    shape = document.createElement('div');
                    Object.assign(shape.style, {
                        width: '70px',
                        height: '70px',
                        backgroundColor: shapeColor,
                        transform: 'rotate(45deg)'
                    });
                    break;
                case 'star':
                    shape = document.createElement('div');
                    shape.innerHTML = '★';
                    Object.assign(shape.style, {
                        fontSize: '80px',
                        color: shapeColor,
                        lineHeight: '1',
                        textAlign: 'center'
                    });
                    break;
                case 'hexagon':
                    shape = document.createElement('div');
                    Object.assign(shape.style, {
                        width: '80px',
                        height: '70px',
                        backgroundColor: shapeColor,
                        clipPath: 'polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%)'
                    });
                    break;
            }
            
            shape.className = 'select-none';
            shape.style.userSelect = 'none';
            
            // Add delete button
            const deleteBtn = createDeleteButton();
            container.appendChild(shape);
            container.appendChild(deleteBtn);
            
            // Add resize handles
            addResizeHandles(container);

            container.onclick = (e) => {
                e.stopPropagation();
                selectElement(container);
            };
            makeDraggable(container);
            document.getElementById('design-area').appendChild(container);
            selectElement(container);
        }

        // Utility functions
        function createDeleteButton() {
            const deleteBtn = document.createElement('div');
            deleteBtn.className = 'element-delete-btn';
            deleteBtn.innerHTML = '×';
            deleteBtn.onclick = (e) => {
                e.stopPropagation();
                if (confirm('Are you sure you want to delete this element?')) {
                    e.target.parentElement.remove();
                    selectedElement = null;
                }
            };
            return deleteBtn;
        }

        function addResizeHandles(container) {
            // Create resize handles
            const positions = ['tl', 'tr', 'bl', 'br'];
            positions.forEach(pos => {
                const handle = document.createElement('div');
                handle.className = `resize-handle ${pos}`;
                handle.dataset.handle = pos;
                container.appendChild(handle);
                
                handle.addEventListener('mousedown', startResize);
            });
        }

        function startResize(e) {
            e.stopPropagation();
            e.preventDefault();
            
            const handle = e.target;
            const container = handle.parentElement;
            const pos = handle.dataset.handle;
            
            const startX = e.clientX;
            const startY = e.clientY;
            const startWidth = container.offsetWidth;
            const startHeight = container.offsetHeight;
            const startLeft = container.offsetLeft;
            const startTop = container.offsetTop;
            
            function doResize(e) {
                e.preventDefault();
                
                let newWidth = startWidth;
                let newHeight = startHeight;
                let newLeft = startLeft;
                let newTop = startTop;
                
                // Calculate new dimensions based on handle position
                switch(pos) {
                    case 'tl':
                        newWidth = startWidth - (e.clientX - startX);
                        newHeight = startHeight - (e.clientY - startY);
                        newLeft = startLeft + (e.clientX - startX);
                        newTop = startTop + (e.clientY - startY);
                        break;
                    case 'tr':
                        newWidth = startWidth + (e.clientX - startX);
                        newHeight = startHeight - (e.clientY - startY);
                        newTop = startTop + (e.clientY - startY);
                        break;
                    case 'bl':
                        newWidth = startWidth - (e.clientX - startX);
                        newHeight = startHeight + (e.clientY - startY);
                        newLeft = startLeft + (e.clientX - startX);
                        break;
                    case 'br':
                        newWidth = startWidth + (e.clientX - startX);
                        newHeight = startHeight + (e.clientY - startY);
                        break;
                }
                
                // Apply new dimensions if they're reasonable
                if (newWidth > 20) {
                    container.style.width = `${newWidth}px`;
                    container.style.left = `${newLeft}px`;
                }
                
                if (newHeight > 20) {
                    container.style.height = `${newHeight}px`;
                    container.style.top = `${newTop}px`;
                }
            }
            
            function stopResize() {
                document.removeEventListener('mousemove', doResize);
                document.removeEventListener('mouseup', stopResize);
            }
            
            document.addEventListener('mousemove', doResize);
            document.addEventListener('mouseup', stopResize);
        }

        function makeDraggable(element) {
            let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
            
            element.addEventListener('mousedown', dragMouseDown);
            
            function dragMouseDown(e) {
                e = e || window.event;
                e.preventDefault();
                
                // Check if clicking on a resize handle or delete button
                if (e.target.classList.contains('resize-handle') || 
                    e.target.classList.contains('element-delete-btn')) {
                    return;
                }
                
                pos3 = e.clientX;
                pos4 = e.clientY;
                document.addEventListener('mouseup', closeDragElement);
                document.addEventListener('mousemove', elementDrag);
            }
            
            function elementDrag(e) {
                e = e || window.event;
                e.preventDefault();
                
                pos1 = pos3 - e.clientX;
                pos2 = pos4 - e.clientY;
                pos3 = e.clientX;
                pos4 = e.clientY;
                
                // Calculate new position
                let newTop = element.offsetTop - pos2;
                let newLeft = element.offsetLeft - pos1;
                
                // Apply new position
                element.style.top = newTop + "px";
                element.style.left = newLeft + "px";
            }
            
            function closeDragElement() {
                document.removeEventListener('mouseup', closeDragElement);
                document.removeEventListener('mousemove', elementDrag);
            }
        }

        function selectElement(element) {
            // Deselect any previously selected element
            if (selectedElement) {
                selectedElement.style.border = '1px dashed transparent';
                selectedElement.style.zIndex = '1';
                
                // Hide resize handles
                const handles = selectedElement.querySelectorAll('.resize-handle');
                handles.forEach(handle => {
                    handle.style.display = 'none';
                });
            }
            
            // Select the new element
            selectedElement = element;
            selectedElement.style.border = '1px dashed #3b82f6';
            selectedElement.style.zIndex = '10';
            
            // Show resize handles
            const handles = selectedElement.querySelectorAll('.resize-handle');
            handles.forEach(handle => {
                handle.style.display = 'block';
            });
            
            // Update UI based on selected element
            updateUIforSelectedElement(element);
            
            // Deselect when clicking outside
            const designArea = document.getElementById('design-area');
            const handleClick = (e) => {
                if (e.target === designArea) {
                    if (selectedElement) {
                        selectedElement.style.border = '1px dashed transparent';
                        selectedElement.style.zIndex = '1';
                        
                        // Hide resize handles
                        const handles = selectedElement.querySelectorAll('.resize-handle');
                        handles.forEach(handle => {
                            handle.style.display = 'none';
                        });
                    }
                    selectedElement = null;
                    updateUIforSelectedElement(null);
                    designArea.removeEventListener('click', handleClick);
                }
            };
            
            designArea.addEventListener('click', handleClick);
        }

        function updateUIforSelectedElement(element) {
            // Update text editing UI
            document.getElementById('textContentInput').value = '';
            
            // Show/hide shape color section based on element type
            const shapeColorSection = document.getElementById('shapeColorSection');
            
            if (element && element.dataset.shapeType) {
                shapeColorSection.classList.remove('hidden');
            } else {
                shapeColorSection.classList.add('hidden');
            }
            
            if (!element) return;
            
            // If it's a text element, update the text content input
            const textElement = element.querySelector('div[contenteditable="true"]');
            if (textElement) {
                document.getElementById('textContentInput').value = textElement.innerText;
                
                // Update font properties
                const fontFamily = textElement.style.fontFamily.split(',')[0].replace(/['"]/g, '');
                const fontSize = parseInt(textElement.style.fontSize);
                const color = textElement.style.color;
                const textAlign = textElement.style.textAlign;
                
                // Set the UI controls to match
                const fontSelect = document.getElementById('fontSelect');
                for (let i = 0; i < fontSelect.options.length; i++) {
                    if (fontSelect.options[i].value === fontFamily) {
                        fontSelect.selectedIndex = i;
                        break;
                    }
                }
                
                document.getElementById('fontSizeInput').value = fontSize || 18;
                document.getElementById('colorInput').value = rgbToHex(color) || '#000000';
                document.getElementById('colorHex').textContent = rgbToHex(color) || '#000000';
            }
        }

        function rgbToHex(rgb) {
            // Check if already hex
            if (rgb && rgb.startsWith('#')) return rgb;
            
            // Extract RGB values from string like "rgb(0, 0, 0)"
            if (!rgb || !rgb.startsWith('rgb')) return '#000000';
            
            const matches = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
            if (!matches || matches.length !== 4) return '#000000';
            
            function hex(x) {
                return ("0" + parseInt(x).toString(16)).slice(-2);
            }
            
            return "#" + hex(matches[1]) + hex(matches[2]) + hex(matches[3]);
        }

        function applyStyles() {
            if (!selectedElement) return;
            
            const textElement = selectedElement.querySelector('div[contenteditable="true"]');
            if (!textElement) return;
            
            const fontFamily = document.getElementById('fontSelect').value;
            const fontSize = document.getElementById('fontSizeInput').value;
            const color = document.getElementById('colorInput').value;
            const text = document.getElementById('textContentInput').value;
            
            textElement.style.fontFamily = fontFamily;
            textElement.style.fontSize = fontSize + 'px';
            textElement.style.color = color;
            
            if (text) {
                textElement.innerText = text;
            }
        }

        function applyShapeColor() {
            if (!selectedElement || !selectedElement.dataset.shapeType) return;
            
            const shapeElement = selectedElement.firstChild;
            const color = document.getElementById('shapeColorInput').value;
            
            switch(selectedElement.dataset.shapeType) {
                case 'rect':
                case 'circle':
                case 'diamond':
                case 'hexagon':
                    shapeElement.style.backgroundColor = color;
                    break;
                case 'triangle':
                    shapeElement.style.borderBottomColor = color;
                    break;
                case 'star':
                    shapeElement.style.color = color;
                    break;
            }
        }

        function toggleStyle(style) {
            if (!selectedElement) return;
            
            const textElement = selectedElement.querySelector('div[contenteditable="true"]');
            if (!textElement) return;
            
            switch(style) {
                case 'bold':
                    if (textElement.style.fontWeight === 'bold') {
                        textElement.style.fontWeight = 'normal';
                    } else {
                        textElement.style.fontWeight = 'bold';
                    }
                    break;
                case 'italic':
                    if (textElement.style.fontStyle === 'italic') {
                        textElement.style.fontStyle = 'normal';
                    } else {
                        textElement.style.fontStyle = 'italic';
                    }
                    break;
                case 'underline':
                    if (textElement.style.textDecoration === 'underline') {
                        textElement.style.textDecoration = 'none';
                    } else {
                        textElement.style.textDecoration = 'underline';
                    }
                    break;
            }
        }

        function alignText(alignment) {
            if (!selectedElement) return;
            
            const textElement = selectedElement.querySelector('div[contenteditable="true"]');
            if (!textElement) return;
            
            textElement.style.textAlign = alignment;
        }

        function deleteSelectedElement() {
            if (!selectedElement) return;
            
            if (confirm('Are you sure you want to delete this element?')) {
                selectedElement.remove();
                selectedElement = null;
                updateUIforSelectedElement(null);
            }
        }

        function saveDesign() {
            // Clone the current design
            const designArea = document.getElementById('design-area');
            const clonedDesign = designArea.cloneNode(true);
            
            // Remove any interactive elements from the clone
            const deleteButtons = clonedDesign.querySelectorAll('.element-delete-btn');
            deleteButtons.forEach(btn => btn.remove());
            
            const resizeHandles = clonedDesign.querySelectorAll('.resize-handle');
            resizeHandles.forEach(handle => handle.remove());
            
            // Remove selection styles
            const elements = clonedDesign.querySelectorAll('.element-container');
            elements.forEach(element => {
                element.style.border = 'none';
                element.style.zIndex = '1';
            });
            
            // Create a JSON representation
            const designConfig = [];
            elements.forEach(element => {
                const elementData = {
                    type: element.dataset.type || 'text',
                    shapeType: element.dataset.shapeType || null,
                    position: {
                        top: element.style.top,
                        left: element.style.left,
                        width: element.style.width,
                        height: element.style.height
                    }
                };
                
                if (element.dataset.shapeType) {
                    const shapeElement = element.querySelector('div');
                    if (shapeElement) {
                        elementData.style = {
                            backgroundColor: shapeElement.style.backgroundColor,
                            borderBottomColor: shapeElement.style.borderBottomColor,
                            color: shapeElement.style.color
                        };
                    }
                } else {
                    const textElement = element.querySelector('div[contenteditable="true"]');
                    if (textElement) {
                        elementData.content = textElement.innerText;
                        elementData.style = {
                            fontFamily: textElement.style.fontFamily,
                            fontSize: textElement.style.fontSize,
                            color: textElement.style.color,
                            fontWeight: textElement.style.fontWeight,
                            fontStyle: textElement.style.fontStyle,
                            textDecoration: textElement.style.textDecoration,
                            textAlign: textElement.style.textAlign,
                            borderBottom: textElement.style.borderBottom
                        };
                    }
                }
                
                designConfig.push(elementData);
            });
            
            // Convert to JSON
            const designJSON = JSON.stringify(designConfig);
            
            // In a real application, send this to the server
            alert('Design saved successfully!');
            console.log('Design JSON:', designJSON);
            
            // Here you would typically make an AJAX call to save the design
            // fetch('/api/save-certificate-design', {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/json',
            //     },
            //     body: designJSON
            // })
            // .then(response => response.json())
            // .then(data => {
            //     console.log('Success:', data);
            //     alert('Design saved successfully!');
            // })
            // .catch((error) => {
            //     console.error('Error:', error);
            //     alert('Failed to save design!');
            // });
        }

        function downloadCertificate() {
            const designArea = document.getElementById('design-area');
            
            // Hide any interactive elements temporarily
            const deleteButtons = designArea.querySelectorAll('.element-delete-btn');
            deleteButtons.forEach(btn => btn.style.display = 'none');
            
            const resizeHandles = designArea.querySelectorAll('.resize-handle');
            resizeHandles.forEach(handle => handle.style.display = 'none');
            
            // Remove selection styles temporarily
            let selectedElementBorder = null;
            if (selectedElement) {
                selectedElementBorder = selectedElement.style.border;
                selectedElement.style.border = 'none';
            }
            
            // Use html2canvas to capture the current state
            html2canvas(designArea).then(canvas => {
                // Restore the UI elements
                deleteButtons.forEach(btn => btn.style.display = '');
                resizeHandles.forEach(handle => btn.style.display = '');
                
                if (selectedElement && selectedElementBorder) {
                    selectedElement.style.border = selectedElementBorder;
                }
                
                // Create the download link
                const link = document.createElement('a');
                link.download = 'certificate.png';
                link.href = canvas.toDataURL('image/png');
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
        }

        function clearDesign() {
            if (confirm('Are you sure you want to clear all elements? This cannot be undone.')) {
                const designArea = document.getElementById('design-area');
                const background = designArea.querySelector('img');
                
                // Clear all elements except the background
                while (designArea.firstChild) {
                    designArea.removeChild(designArea.firstChild);
                }
                
                // Add back the background
                if (background) {
                    designArea.appendChild(background);
                }
                
                selectedElement = null;
                updateUIforSelectedElement(null);
            }
        }

        </script>

</x-layout>