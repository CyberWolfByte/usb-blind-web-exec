# Cross-Platform Web Delivery (Windows)

This project showcases a versatile USB Rubber Ducky payload designed for "blind" execution across multiple operating systems, including Windows, macOS, and certain Linux distributions. The payload's simplicity and cross-compatibility enable it to use universal shortcuts to open web browsers and navigate to a specified URL without needing to detect the target OS. Additionally, the project includes a PHP listener script to capture and log data from the target system when it accesses the provided URL.

**Objective:** Combine a web delivery payload with a PHP listener to log IP and browser data from the target.

## Disclaimer

The tools and scripts provided in this repository are made available for educational purposes only and are intended to be used for testing and protecting systems with the consent of the owners. The author does not take any responsibility for the misuse of these tools. It is the end user's responsibility to obey all applicable local, state, national, and international laws. The developers assume no liability and are not responsible for any misuse or damage caused by this program. Under no circumstances should this tool be used for malicious purposes. The author of this tool advocates for the responsible and ethical use of security tools. Please use this tool responsibly and ethically, ensuring that you have proper authorization before engaging any system with the techniques demonstrated by this project.

## Features

**DuckyScript Payload**: This DuckyScript payload is designed to operate across different operating systems, open a browser, then to the attacker’s PHP URL.

**listener.php**: This PHP script is designed to log visit information (IP address, browser data, etc.) from the target system. This script should be hosted on a web server accessible by the target machine. It captures the headers, server information, request details, and timestamps each access. The data is saved to text files for analysis, and an email notification is sent out if desired.

## Prerequisites

- **Operating System**: Tested on Windows 10 x64, version 22H2, Kali Linux 2023.4
- **Payload Studio**: Tested with Payload Studio Pro version 1.3.1
- **DuckyScript Version**: DuckScript 3.0 Advanced
- **Hardware**: Hak5 USB Rubber Ducky (2022)

## Usage

### Step 1: **Install Apache and PHP (Kali Linux)**

Kali Linux comes with Apache and PHP available in its repositories. Check with the `-v` command.

1. **Update Your Package List:** `sudo apt update`
2. **Install Apache2**: `sudo apt install apache2`
3. **Install PHP**: Kali Linux usually includes PHP in its default installation. If it's missing for any reason, you can install it along with the common module for Apache by running: `sudo apt install php libapache2-mod-php`
4. **Start the Apache Service**: `sudo systemctl start apache2`
5. **Enable Apache to Start at Boot**: `sudo systemctl enable apache2`
    
    <aside>
    ⚠️ Remove Apache service from the system's startup sequence after completing exploit tests: `sudo systemctl disable apache2`
    
    </aside>
    

### **Step 2: Configure PHP Listener Script**

1. **Place Your PHP Script**:
    - Navigate to the web root directory, typically `/var/www/html/` in Apache on Kali Linux.
    - Create a new file for your listener script: `sudo nano /var/www/html/listener.php`
2. **Insert the PHP Script**:
    - Copy and paste your PHP listener script into the editor.
    - (Optional) Make sure to adjust  `'email@example.com'` and other parameters to match your requirements. You can use a Temp Mail inbox for testing: https://temp-mail.org/en/
    - Save and exit the editor (`CTRL + X`, then `Y` to confirm, and `Enter` to save in nano).

### **Step 3: Validate Configurations**

1. **Update DuckScript Payload:**
    - Replace `http://example.com` with `http://localhost/listener.php` or `http://<your-Kali-VM-IP>/listener.php`.
2. **Access the Listener Script**:
    - Open a web browser and navigate to `http://localhost/listener.php` or `http://<your-Kali-VM-IP>/listener.php` from the target host on the same network.
3. **Check for Data**:
    - Verify that the script is working as expected by checking the files it's supposed to write to or waiting for the email notification (if applicable).
    - For file checks, you can use `cat` or `nano` to view the contents, e.g., `sudo cat /var/www/html/summary.txt`.
4. **Troubleshooting:** If the PHP script doesn't execute as expected, check Apache's error logs for clues (`/var/log/apache2/error.log`).
    
    <aside>
    ⚠️ File Permissions:
    
    - The PHP script may not be creating files due to insufficient permissions on the directory where it's trying to write the files. Ensure that the Apache user (usually `www-data` on Debian-based systems like Kali Linux) has write permissions to the directory.
    - You can adjust the permissions with the following command, executed in the directory where you want the files to be created (`/var/www/html` for default Apache installations):
        
        `sudo chown -R www-data:www-data /var/www/html`
        `sudo chmod -R 755 /var/www/html`
        
    </aside>
    

## How It Works

### DuckyScript Payload:

- `DEFINE WEBSITE http://example.com` sets the target URL.
- `ALT F2`, `COMMAND SPACE`, and `GUI r` are attempts to open the run command or search functionality across different OSes (Linux, macOS, and Windows respectively).
- `STRING WEBSITE` inputs the URL.
- `ENTER` executes the command to navigate to the website.

### **listener.php**:

- Captures the current date and time, request headers, server information, and request data.
- Logs summary information to a file named "summary.txt" and detailed data to "full-data.txt". These files will be created in the same directory as the PHP script on the server.
- Sends an email notification containing the access date and the remote IP address.
- Redirects visitors to a cybersecurity awareness tip page using both meta refresh and JavaScript for redundancy.

## Output Example

![DuckyScript Payload Results](/images/web_exec_results.png)

![DuckyScript Payload Results](/images/url_destination.png)

## Contributing

If you have an idea for an improvement or if you're interested in collaborating, you are welcome to contribute. Please feel free to open an issue or submit a pull request.

## License

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see https://www.gnu.org/licenses/.
