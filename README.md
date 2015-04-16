# MCMapAnalytics
The source code for http://crushedpixel.eu/analytics, a web service that allows map makers to track the amount of players using their creations.

## Introduction
MCMapAnalytics is a tool for Mapmakers that allows them to collect statistics about the Minecraft Players using their maps.

It's easy to use - simply place a Player Head in your creation, and every individual player loading this Head gets tracked in your statistics.
Note that every player will only get counted once.

### How it works
The Custom Player Head in your map or contraption that loads it's skin file from the MCMapAnalytics servers. Once a Minecraft client downloads the skin, the player's Java Version, Country and Provider are stored anonymously.
