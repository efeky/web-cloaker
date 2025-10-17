⚠️ WARNING: This project is educational and testing purposes only.
Do not deploy this project against third‑party sites or use it for deceptive, fraudulent, or illegal activities (e.g., ad fraud, phishing, search‑engine manipulation). Always obtain explicit permission from the site owner, follow applicable laws and platform terms of service, and handle any collected data in compliance with privacy regulations (GDPR, KVKK, etc.).

Web‑Cloaker is an educational proof‑of‑concept that demonstrates web cloaking and basic bot/human differentiation techniques. The project shows how a web server can detect, log, and respond differently to traffic identified as bots (e.g., search engine crawlers, automated scanners) versus traffic identified as humans. It collects lightweight fingerprints, performs heuristic checks (User‑Agent, IP/ISP/country lookups, reverse DNS, honeypot fields), stores fingerprint data, and serves distinct content (bot.html or normal.html) depending on the result.


1️⃣-
Bot or Human Detection: Differentiates between bots (search engine crawlers, automated scanners) and human visitors.

2️⃣-
Fingerprint Collection: Gathers lightweight fingerprints based on IP, User-Agent, ISP, country, and other heuristics.

3️⃣-
Heuristic Checks: Uses multiple techniques including User-Agent verification, IP/ISP/country lookups, reverse DNS checks, and honeypot fields.

4️⃣-
Database Logging: Stores fingerprints and visitor logs for analysis.

5️⃣-
Blacklist Support: Maintains IP/ISP/country blacklists to identify suspicious traffic.

6️⃣-
Honeypot Mechanism: Detects unsophisticated bots by checking hidden form fields.

7️⃣-
Server-Side Fingerprinting: Generates hashes for fingerprint data to track visitors consistently.

8️⃣-
Educational and Modifiable: Clear PHP code that can be modified for testing or learning purposes.

GPL-3.0 Licensed: Open source under GPL-3.0, suitable for educational use.
