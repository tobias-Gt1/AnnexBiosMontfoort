<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Agenda</title>
    <style>
        * {
            margin: 110;
            padding: 0;
            box-sizing: border-box;
        }

        body {  
            background: black;
            align-items: center;
            justify-content: center;
        }

        /* .agenda-container {
            background: linear-gradient(135deg, #2c1810 0%, #1a0f0a 100%);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 100%;
            border: 1px solid #3a2418;
        } */

        .header {
            margin-bottom: 20px;
        }

        .title {
            color: #4A90E2;
            font-size: 2.2rem;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 15px;
        }
 


        .filter-tabs {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

         .tab {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 10px 16px;
            background: #ffffffff;
            border: 2px solid #4A90E2;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
            color: #333;
            position: relative;
            overflow: hidden;
        }

        /* .tab:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        } */

        .tab:hover:before {
            left: 100%;
        }

        .tab.active {
            background: #4A90E2;
            color: white;
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(74, 144, 226, 0.3);
        }

        .tab:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(74, 144, 226, 0.2);
        }

        .tab-icon {
            font-size: 16px;
        }

        .dropdown-icon {
            margin-left: auto;
            transition: transform 0.3s ease;
        }

        /* .tab.dropdown:hover .dropdown-icon {
            transform: rotate(180deg);
        } */

        /* Responsive design */
        @media (max-width: 480px) {
            .title {
                font-size: 1.8rem;
            }
            
            .tab {
                font-size: 12px;
                padding: 8px 12px;
            }
            
            .filter-tabs {
                gap: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="agenda-container">
        <div class="header">
            <h1 class="title">FILM AGENDA</h1>
            
            <div class="menu-icon" onclick="toggleMenu()">
                <div class="menu-line"></div>
                <div class="menu-line"></div>
                <div class="menu-line"></div>
            </div>
        </div>

        <div class="filter-tabs">
            <div class="tab active" onclick="setActiveTab(this)">
                <span class="tab-icon">🎬</span>
                FILMS
            </div>
            
            <div class="tab" onclick="setActiveTab(this)">
                <span class="tab-icon">📅</span>
                DEZE WEEK
            </div>
            
            <div class="tab" onclick="setActiveTab(this)">
                <span class="tab-icon">📆</span>
                VANDAAG
            </div>
            
            <div class="tab dropdown" onclick="setActiveTab(this)">
                <span class="tab-icon">🎭</span>
                CATEGORIE
                <span class="dropdown-icon">🔽</span>
            </div>
        </div>
    </div>

    <script>
        function setActiveTab(clickedTab) {
            // Remove active class from all tabs
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => tab.classList.remove('active'));
            
            // Add active class to clicked tab
            clickedTab.classList.add('active');
        }

        function toggleMenu() {
            const menuLines = document.querySelectorAll('.menu-line');
            menuLines.forEach(line => {
                line.style.transform = line.style.transform === 'rotate(45deg)' ? 'rotate(0deg)' : 'rotate(45deg)';
            });
        }

        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab');
            
            tabs.forEach(tab => {
                tab.addEventListener('mouseenter', function() {
                    if (!this.classList.contains('active')) {
                        this.style.borderColor = '#667eea';
                    }
                });
                
                tab.addEventListener('mouseleave', function() {
                    if (!this.classList.contains('active')) {
                        this.style.borderColor = '#4A90E2';
                    }
                });
            });
        });
    </script>
</body>
</html>